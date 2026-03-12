<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('gateway')->nullable()->after('payment_method')->comment('razorpay or stripe');
            $table->string('transaction_id')->nullable()->after('razorpay_payment_id');
            $table->string('currency')->default('INR')->after('amount_paid');
            $table->string('payment_status')->nullable()->after('status')->comment('Gateways specific status');
            $table->string('receipt_number')->nullable()->after('id')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn([
                'gateway',
                'transaction_id',
                'currency',
                'payment_status',
                'receipt_number'
            ]);
        });
    }
};
