<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            // Tambahkan log untuk memastikan role benar
            logger()->info('Login berhasil dengan role: ' . $user->role);
    
            if ($user->role === 'admin') {
                return redirect()->route('dashboard_admin');
            } elseif ($user->role === 'user') {
                return redirect()->route('dashboard_user');
            }
        }
    
        logger()->error('Login gagal dengan email: ' . $request->email);
    
        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }
    
    

    // Proses logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login'); 
    }


}
