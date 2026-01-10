<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles  // '...' (splat operator) untuk menerima banyak role
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            abort(403, 'ANDA TIDAK PUNYA HAK AKSES.');
        }

        // Ambil role user yang sedang login
        $userRole = Auth::user()->role;

        // Cek apakah role user ada di dalam daftar $roles yang diizinkan
        if (!in_array($userRole, $roles)) {
            abort(403, 'ANDA TIDAK PUNYA HAK AKSES.');
        }
        
        // Jika user punya role yang diizinkan, lanjutkan
        return $next($request);
    }
}