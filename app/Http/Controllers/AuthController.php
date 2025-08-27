<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;     
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    
    public function proseslogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            /** @var \App\Models\User $user */
            if (strtolower($user->email) === 'admin@gmail.com' && $user->role !== 'admin') {
                 $user->update(['role' => 'admin']); 
            }

            if ($user->role === 'admin') {
                return redirect()->route('dashboard')->with('success', 'Selamat datang Admin');
            }

            return redirect()->route('user.dashboard')->with('success', 'Login berhasil');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->onlyInput('email');
    }

    
    public function showRegister()
    {
        return view('auth.register');
    }

   
    public function dashboard()
    {
        return view('dashboard');
    }

    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:225',
            'username' => 'required|string|max:15|unique:users',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['name', 'username', 'email']);
        $data['password'] = Hash::make($request->password);

        
        $data['role'] = (strtolower($data['email']) === 'admin@gmail.com') ? 'admin' : 'user';

        $user = User::create($data);

        Auth::login($user);

       
        if ($user->role === 'admin') {
            return redirect()->route('dashboard')->with('success', 'Akun Admin berhasil terdaftar');
        }

        return redirect()->route('user.dashboard')->with('success', 'Akun berhasil terdaftar');
    }
}
