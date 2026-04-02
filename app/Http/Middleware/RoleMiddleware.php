<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (!$user) {
            return redirect('/login');
        }

        // Pecahkan string role jika dipisahkan dengan koma
        $allowedRoles = explode(',', $roles[0]);

        if (!$user->role || !in_array($user->role->role_name, $allowedRoles)) {
            abort(403, 'ANDA TIDAK DIBENARKAN MENGAKSES HALAMAN INI');
        }

        return $next($request);
    }
}
