<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class roleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            abort(403, 'Unauthorized access'); // Atau redirect ke halaman login
        }

        // Ambil role_id dari user yang login
        $roleId = Auth::user()->role_id;

        // Validasi role_id
        if ($role === 'admin' && $roleId !== 1) {
            abort('Access restricted to admins only.');
        } elseif ($role === 'user' && $roleId !== 2) {
            abort(403, 'Access restricted to regular users only.');
        }

        // Jika lolos validasi, lanjutkan request
        return $next($request);
    }


}


