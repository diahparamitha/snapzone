<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
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

        // dd($credentials);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->isAdminStaff() === true) {
                return redirect('/admin/index'); // Mengarahkan pengguna dengan peran admin/staff ke halaman dashboard admin
            } else {
                return redirect('/'); // Mengarahkan pengguna dengan peran user ke halaman dashboard user
            }
        }
        return back()->with(['login' => 'Login gagal!']); 
    }

     public function logout(Request $request) //untuk logout
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');   //diarahkan ke halaman utama
    }
}
