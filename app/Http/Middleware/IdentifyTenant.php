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
        $user = auth()->user() ?: auth()->guard('student')->user();

        if ($user && isset($user->institute_id)) {
            session(['institute_id' => $user->institute_id]);
        }

        return $next($request);
    }
}
