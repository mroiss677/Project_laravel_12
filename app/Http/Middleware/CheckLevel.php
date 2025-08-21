<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware untuk memeriksa level akses pengguna
 */

class CheckLevel
{
    public function handle(Request $request, Closure $next, $level)
    {
        if (!auth()->check() || auth()->user()->level !== $level) {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}
