<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KontenController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Konten;
use App\Http\Middleware\RoleMiddleware;


Route::get('/', function () {
    $konten = Konten::with('kategori')->latest()->get();
    return view('welcome', compact('konten'));
})->name('home');


Route::middleware('guest')->group(function () {
    Route::get('/login', fn() => view('auth.login'))->name('login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/proseslogin', [AuthController::class, 'proseslogin'])->name('proseslogin');
});


Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home');
})->middleware('auth')->name('logout');


Route::middleware(['auth', RoleMiddleware::class.':admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('kategori', KategoriController::class); 
    Route::resource('konten', KontenController::class);     
});


Route::middleware(['auth', RoleMiddleware::class.':user'])->prefix('user')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    
    Route::resource('konten', KontenController::class)->only([
        'index','create','store','edit','update','destroy'
    ]);
});
