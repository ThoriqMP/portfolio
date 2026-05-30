<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show the CMS admin login form.
     */
    public function showLogin()
    {
        // If already logged in, redirect directly to dashboard
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('cms.login');
    }

    /**
     * Handle the admin authentication request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Attempt authentication
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang kembali, ' . Auth::user()->name . '!');
        }

        // Authentication failed
        throw ValidationException::withMessages([
            'username' => __('Username atau password yang Anda masukkan salah.'),
        ]);
    }

    /**
     * Handle the admin logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Anda telah berhasil keluar dari panel admin.');
    }
}
