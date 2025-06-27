<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class BeritaController extends Controller
{
    public function berita_page()
    {
        $berita = Berita::where('status', 'published')
                        ->orderBy('created_at', 'desc') // atau 'updated_at' kalau pakai yang terbaru diedit
                        ->paginate(6);
        return view('user.berita', compact('berita'));
    }

    public function isi_berita($id)
    {
        $berita = Berita::findOrFail($id);
        return view('user.isi-berita', compact('berita'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'isi' => $request->isi,
            'gambar' => $gambarPath,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Berita berhasil disimpan!');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $berita = Berita::findOrFail($id);

        // Update gambar jika ada yang baru
        if ($request->hasFile('gambar')) {
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $gambarPath = $request->file('gambar')->store('berita', 'public');
            $berita->gambar = $gambarPath;
        }

        $berita->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Berita berhasil diperbarui!');
    }
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $berita->delete();
        return redirect()->back()->with('success', 'Berita berhasil dihapus!');
    }
}
