<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated',
                    'error' => 'UNAUTHENTICATED'
                ], 401);
            }
            return redirect('/login');
        }

        $user = Auth::user();

        // 2. Cek apakah role user ada di dalam daftar role yang diperbolehkan
        if (!in_array($user->role, $roles)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akses ditolak.',
                    'error' => 'FORBIDDEN'
                ], 403);
            }

            // 3. Jika role TIDAK COCOK, lempar ke dashboard masing-masing agar tidak loop
            // PASTIKAN URL DI BAWAH INI SAMA DENGAN DI ROUTES/WEB.PHP
            $redirectUrl = match ($user->role) {
                'Admin'               => '/admin/dashboard',
                'Manajer Operasional' => '/manajer/dashboard', // Sesuaikan jika URL Anda beda
                'Staf Registrasi'     => '/staff/dashboard',   // Sesuaikan jika URL Anda beda
                default               => '/',
            };

            return redirect($redirectUrl)->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        return $next($request);
    }
}