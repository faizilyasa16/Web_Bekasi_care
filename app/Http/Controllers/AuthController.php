<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function regist()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'nik' => 'required|unique:users|integer',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nik' => $request->nik,
        ]);

        return redirect('login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required',
            'password' => 'required',
        ]);

        if (auth()->attempt($validated)) {
            $request->session()->regenerate();

            $user = auth()->user();
            if ($user->role === 'admin') {
                return redirect()->route('dashboard');
            }

            return redirect()->route('home');
        }

        return back()->withErrors([
            'nik' => 'The provided credentials do not match our records.',
            'password' => 'The provided credentials do not match our records.',
        ]);
    }

    public function change()
    {
        return view('user.profile.ubah-password');
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
}
