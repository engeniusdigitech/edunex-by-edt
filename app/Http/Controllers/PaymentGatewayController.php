<?php

namespace App\Http\Controllers;

use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentGatewayController extends Controller
{
    /**
     * Show the form for editing the gateway settings.
     */
    public function settings()
    {
        $instituteId = Auth::user()->institute_id;
        $gateway = PaymentGateway::firstOrCreate(
        ['institute_id' => $instituteId]
        );

        return view('payment_gateways.settings', compact('gateway'));
    }

    /**
     * Update the gateway settings in storage.
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'razorpay_key' => 'nullable|string|max:255',
            'razorpay_secret' => 'nullable|string|max:255',
            'stripe_public_key' => 'nullable|string|max:255',
            'stripe_secret_key' => 'nullable|string|max:255',
            'stripe_webhook_secret' => 'nullable|string|max:255',
        ]);

        $instituteId = Auth::user()->institute_id;
        $gateway = PaymentGateway::firstOrCreate(['institute_id' => $instituteId]);

        $gateway->update([
            'razorpay_key' => $request->razorpay_key,
            'razorpay_secret' => $request->razorpay_secret,
            'stripe_public_key' => $request->stripe_public_key,
            'stripe_secret_key' => $request->stripe_secret_key,
            'stripe_webhook_secret' => $request->stripe_webhook_secret,
        ]);

        return redirect()->route('payment-gateways.settings')->with('success', 'Payment gateway keys updated successfully.');
    }
}
