<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        // Periksa apakah pengguna terautentikasi
        if (!auth()->check()) {
            // Jika belum login, redirect ke halaman login
            return redirect('/login')->with('message', 'Please provide your login details to access your account!');
        }

        if (is_null($request->user()->role)) {
            // Logout pengguna dan redirect ke halaman login jika role null
            Auth::logout();
            return redirect('/login')->with('message', 'Your session has expired. Please log in again.');
        }
        
        if ($request->user()->role != $role) {
            return abort(403, 'You do not have the right to access the page!');;
        }

        return $next($request);
    }
}
