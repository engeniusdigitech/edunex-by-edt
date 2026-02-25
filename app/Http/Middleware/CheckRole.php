<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request by ensuring the user has the required role.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check() || auth()->user()->role->name !== $role) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
