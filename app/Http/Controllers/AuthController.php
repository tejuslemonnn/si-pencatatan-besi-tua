<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $infologin = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        if (Auth::attempt($infologin)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return redirect()->route('home')->withErrors([
            'username' => 'Wrong username or Password!',
            'password' => 'Wrong Password!',
        ]);

        return back()->withErrors([
            'username' => 'Invalid credentials.',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
