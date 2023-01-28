<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  /**
   * Handle an authentication attempt.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function authenticate(Request $request)
  {

    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {

      $request->session()->regenerate();

      return redirect(route('dashboard'));
    }

    return back()->withErrors([
      'email' => 'Por favor, confira se email e senha estão corretos.',
    ])->onlyInput('email');
  }
}
