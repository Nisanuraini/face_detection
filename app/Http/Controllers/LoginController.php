<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input email dan password
        $credentials = $request->only('email', 'password');

        // Cek apakah login berhasil
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek apakah user adalah admin
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard'); // Menuju dashboard admin
            } else {
                Auth::logout(); // Log out jika bukan admin
                return redirect()->route('login')->withErrors('Hanya admin yang dapat login!');
            }
        }

        // Jika login gagal
        return redirect()->route('login')->withErrors('Login gagal!');
    }
}
