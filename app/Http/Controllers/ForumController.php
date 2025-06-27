<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumReply;
use App\Models\Forum;
use Illuminate\Support\Str;

class ForumController extends Controller
{
    public function forum_page()
    {
        $forums = Forum::where('status', 'open')->latest()->get();

        return view('user.forum', compact('forums'));
    }


    public function isi_forum($id)
    {
        // Ambil data forum beserta user & replies-nya
        $forum = Forum::with(['user', 'replies.user'])->findOrFail($id);
        
        // Tambahkan view +1
        $forum->increment('views');

        return view('user.chat-forum', compact('forum'));
    }

    public function store(Request $request)
    {
        // Validasi role yang diperbolehkan
        if (!in_array(auth()->user()->role, ['user', 'admin'])) {
            abort(403, 'Anda tidak memiliki izin untuk membuat forum.');
        }
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:open,closed',
        ]);

        // Daftar kata terlarang
        $forbiddenWords = ['anjing', 'goblok','brengsek', 'bangsat', 'judol', 'cari jodoh'];

        // Fungsi untuk mengecek apakah ada kata terlarang
        $containsForbidden = function ($text) use ($forbiddenWords) {
            foreach ($forbiddenWords as $word) {
                if (Str::contains(Str::lower($text), Str::lower($word))) {
                    return true;
                }
            }
            return false;
        };

        // Cek apakah judul/isi mengandung kata terlarang
        if ($containsForbidden($request->judul) || $containsForbidden($request->isi)) {
            return back()->withErrors(['error' => 'Judul atau isi mengandung kata yang tidak pantas atau dilarang.'])->withInput();
        }

        // Simpan jika lolos validasi
        Forum::create([
            'user_id' => auth()->id(),
            'judul' => $request->judul,
            'isi' => $request->isi,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Forum berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        $forum = Forum::findOrFail($id);

        // Pastikan hanya pemilik atau admin yang boleh edit
        if (auth()->id() !== $forum->user_id && auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak diizinkan mengedit forum ini.');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:open,closed',
        ]);

        // Daftar kata terlarang
        $forbiddenWords = ['anjing', 'kontol', 'bangsat', 'judol', 'cari jodoh'];

        $containsForbidden = function ($text) use ($forbiddenWords) {
            foreach ($forbiddenWords as $word) {
                if (Str::contains(Str::lower($text), Str::lower($word))) {
                    return true;
                }
            }
            return false;
        };

        if ($containsForbidden($request->judul) || $containsForbidden($request->isi)) {
            return back()->withErrors(['error' => 'Judul atau isi mengandung kata yang tidak pantas atau dilarang.'])->withInput();
        }

        // Simpan perubahan
        $forum->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'status' => $request->status,
        ]);

        return redirect()->route('forum', $forum->id)->with('success', 'Forum berhasil diperbarui.');
    }

    public function chat(Request $request, $id)
    {
           $request->validate([
                'isi' => 'required|string|max:1000',
            ]);

            ForumReply::create([
                'forum_id' => $id,
                'user_id' => auth()->id(),
                'isi' => $request->isi,
            ]);

            return back()->with('success', 'Komentar berhasil ditambahkan.'); 
    }

    public function destroy($id)
    {
        $forum = Forum::findOrFail($id);
        $forum->delete();
        return redirect()->back()->with('success', 'Forum berhasil dihapus.');
    }

}
