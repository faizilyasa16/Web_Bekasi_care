<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class ProfileController extends Controller
{
    public function index()
    {
        return view('user.profile.index');
    }
    public function update_user(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'img' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Proses upload foto jika ada
        if ($request->hasFile('img')) {
            // Hapus foto lama jika ada
            if ($user->img && Storage::exists($user->img)) {
                Storage::delete($user->img);
            }

            // Simpan foto baru
            $path = $request->file('img')->store('profile', 'public');
            $user->img = $path;
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        /** @var \App\Models\User $user */
        $user = auth()->user();

        // Cek apakah password lama cocok
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama salah.'])->withInput();
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('ubah-password')->with('success', 'Password berhasil diperbarui.');
    }
}
