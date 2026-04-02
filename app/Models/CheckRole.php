<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Semak jika user wujud DAN jika role user TIDAK SAMA dengan role yang diperlukan
        if (! $request->user() || $request->user()->role !== $role) {
            abort(403, 'Anda tidak mempunyai kebenaran untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}