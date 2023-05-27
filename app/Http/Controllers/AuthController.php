<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function loginAkun(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->isAdmin()) {
                return redirect()->route('login'); // Mengarahkan pengguna dengan peran admin ke halaman dashboard admin
            } else {
                return redirect()->route('landing.index'); // Mengarahkan pengguna dengan peran user ke halaman dashboard user
            }
        }
        return back()->with(['login' => 'Login gagal!']); // Ganti dengan tindakan yang sesuai jika login gagal
    }
}
