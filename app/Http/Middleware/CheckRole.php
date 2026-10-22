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
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userRole = strtolower(auth()->user()->role ?? '');

        if (!empty($roles)) {
            $allowedRoles = [];
            foreach ($roles as $role) {
                foreach (explode(',', $role) as $r) {
                    $trimmed = strtolower(trim($r));
                    if ($trimmed !== '') {
                        $allowedRoles[] = $trimmed;
                    }
                }
            }

            if (!in_array($userRole, $allowedRoles)) {
                abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini. Role Anda: ' . (auth()->user()->role ?? '-'));
            }
        }

        return $next($request);
    }
}
