<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->is_admin == 1 || $user->is_admin === true) {
                return $next($request);
            }
        }

        return redirect()->route('login')->withErrors(['email' => 'Akses ditolak! Silakan login sebagai Admin.']);
    }
}