<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:50|unique:users,nik',
            'email' => 'required|email|unique:users,email',
            'status' => 'nullable|in:terafiliasi,belum-terafiliasi',
            'role' => 'required|in:user,admin',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->back()->with('success', 'User berhasil ditambahkan.');
    }
    
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/',
            'nik' => 'required|digits_between:12,20|unique:users,nik,' . $request->id,
            'email' => 'required|email:dns|unique:users,email,' . $request->id,
            'status' => 'nullable|in:terafiliasi,belum-terafiliasi',
            'role' => 'required|in:user,admin',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($request->id);

        $user->fill([
            'name' => $validated['name'],
            'nik' => $validated['nik'],
            'email' => $validated['email'],
            'status' => $validated['status'],
            'role' => $validated['role'],
        ]);

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->back()->with('success', 'User berhasil diupdate.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }


}
