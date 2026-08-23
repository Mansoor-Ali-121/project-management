<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Login form dikhane ke liye
    public function showLoginForm()
    {
        return view('auth.login'); // Agar login blade view alag hai
    }

  
    // Login request handle karne ke liye
    public function login(Request $request)
    {
        // 1. Validation
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Authentication check
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Agar AJAX/Fetch request hai toh JSON return karo
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login successful!'
                ], 200);
            }

            // Normal request par dashboard ya home par redirect
            return redirect()->intended('/admin-dashboard');
        }

        // Agar login fail ho jaye
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'The provided credentials do not match our records.'
            ], 422);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Logout karne ke liye
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully!'
            ], 200);
        }

        return redirect('/login');
    }
}
