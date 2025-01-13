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
        'email' => 'required|email',
        'password' => 'required',
        ]);
    
        $infologin = [
            'email' => $request -> email,
            'password' => $request -> password,
        ];
        if (Auth::attempt($infologin)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        } 
            return redirect()->route('home')->withErrors([
                'email' => 'Wrong Email or Password!',
                'password' => 'Wrong Password!',
             ]);
        
        return back()->withErrors([
            'email' => 'Invalid credentials.',
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
