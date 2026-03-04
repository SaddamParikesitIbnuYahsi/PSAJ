<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) return redirect('/login');

        $user = Auth::user();
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Redirect cerdas berdasarkan role baru
        $redirectUrl = match ($user->role) {
            'Admin'           => '/admin/dashboard',
            'Staf Registrasi' => '/staff/dashboard',
            'User'            => '/user/dashboard',
            default           => '/',
        };

        return redirect($redirectUrl)->with('error', 'Akses ditolak.');
    }
}