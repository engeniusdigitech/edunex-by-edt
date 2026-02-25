<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IdentifyTenant
{
    /**
     * Handle an incoming request.
     * Maps the authenticated user's institute_id to the session to initialize the TenantScope.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->institute_id) {
            session(['institute_id' => auth()->user()->institute_id]);
        }

        return $next($request);
    }
}
