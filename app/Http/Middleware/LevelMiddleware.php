<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LevelMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $level)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect ke login jika belum login
        }

        // Ambil user yang sedang login
        $user = Auth::user();

        // Periksa apakah level user sesuai dengan parameter middleware
        if (strtolower($user->level) !== strtolower($level)) {
            abort(403, 'Unauthorized Access'); // Tampilkan error 403 jika tidak sesuai
        }

        return $next($request);
    }
}
