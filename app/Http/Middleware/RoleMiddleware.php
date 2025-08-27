<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->withErrors([
                'auth' => 'Silakan login terlebih dahulu.'
            ]);
        }

        $email = strtolower($user->email);

        
        if ($email === 'admin@gmail.com') {
            return $next($request);
        }

        
        if ($role === 'user' && $email !== 'admin@gmail.com') {
            return $next($request);
        }

        return redirect()->route('home')->withErrors([
            'auth' => 'Anda tidak punya akses ke halaman ini.'
        ]);
    }
}
