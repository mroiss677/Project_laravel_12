<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KontenController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Konten;

Route::get('/', function () {
    $konten = Konten::with('kategori')->latest()->get();
    return view('welcome', compact('konten'));
})->name('home');


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout');

// ✅ Gunakan hanya ini untuk dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/proseslogin', [AuthController::class, 'proseslogin'])->name('proseslogin');

Route::resource('kategori', KategoriController::class);
Route::resource('konten', KontenController::class);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
