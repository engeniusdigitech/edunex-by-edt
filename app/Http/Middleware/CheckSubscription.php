<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request ensuring the institute has an active subscription.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Subscription checks disabled as per user request
        /*
         if (auth()->check() && !auth()->user()->isSuperAdmin()) {
         $institute = auth()->user()->institute;
         // E.g. fetch the active subscription
         $activeSub = $institute->subscriptions()->where('status', 'active')->first();
         if (!$activeSub || !$activeSub->isValid()) {
         // Ideally redirect to a "Subscription Expired" page or payment gateway
         return redirect()->route('subscription.expired')->with('error', 'Your subscription has expired. Please renew.');
         }
         }
         */

        return $next($request);
    }
}
