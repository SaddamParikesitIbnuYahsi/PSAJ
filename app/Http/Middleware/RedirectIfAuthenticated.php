<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                
                // Redirect cerdas berdasarkan role pendaftaran umroh
                return match ($user->role) {
                    'Admin'               => redirect('/admin/dashboard'),
                    'Manajer Operasional' => redirect('/manajer/dashboard'),
                    'Staf Registrasi'     => redirect('/staff/dashboard'),
                    default               => redirect('/'),
                };
            }
        }

        return $next($request);
    }
}