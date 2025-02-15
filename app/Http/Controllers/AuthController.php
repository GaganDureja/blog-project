<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  // Show Registration Form
  public function showRegisterForm()
  {
    return view('auth.register');
  }

  // Handle Registration
  public function register(Request $request)
  {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);

    return redirect('/')->with('success', 'Registration successful!');
  }

  // Show Login Form
  public function showLoginForm()
  {
    return view('auth.login');
  }

  // Handle Login
  public function login(Request $request)
  {
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        return redirect('/')->with('success', 'Login successful!');
    }

    return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
  }

  // Handle Logout
  public function logout()
  {
    Auth::logout();
    return redirect('/')->with('success', 'Logged out successfully!');
  }
}
