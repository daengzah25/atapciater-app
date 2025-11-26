<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PICMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (session('pegawai') && session('pegawai')->role == 'pic') {
            return $next($request);
        }

        return redirect()->route('login')->withErrors(['message' => 'Akses ditolak. Hanya untuk PIC.']);
    }
}
