<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  /**
   * view
   */

  public function login()
  {
    return view(''['']);
  }

  /**
   * logical
   */

  public function auth(Request $request)
  {
    $credentials = $request->validate([
      'username' => 'required',
      'password' => 'required'
    ]);

    if(Auth::attempt($credentials))
    {
      $request->session()->regenerate();
      return redirect();
    }
    return back()->withErrors([
      'username' => 'Wrong username',
      'password' => 'Wrong password'
    ]);

  }
  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect(route(''));
  }
}
