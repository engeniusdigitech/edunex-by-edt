<?php

namespace App\Services;

use App\Models\Institute;
use App\Models\Plan;
use App\Models\Subscription;
use Carbon\Carbon;

class SubscriptionService
{
    /**
     * Create or renew a subscription for an institute
     */
    public function renewSubscription(Institute $institute, Plan $plan, string $razorpaySubId = null): Subscription
    {
        $startsAt = Carbon::now();
        $endsAt = Carbon::now()->addDays($plan->duration_days);

        // Check if there's an active subscription to append days instead
        $currentSub = $institute->subscriptions()->where('status', 'active')->latest()->first();
        if ($currentSub && $currentSub->ends_at->isFuture()) {
            $startsAt = $currentSub->ends_at;
            $endsAt = $currentSub->ends_at->copy()->addDays($plan->duration_days);

            $currentSub->update(['status' => 'expired']); // Expire old, create new
        }

        return Subscription::create([
            'institute_id' => $institute->id,
            'plan_id' => $plan->id,
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
            'status' => 'active',
            'razorpay_subscription_id' => $razorpaySubId,
        ]);
    }
}
