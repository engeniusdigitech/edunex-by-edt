<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->foreignId('plan_id')->constrained()->cascadeOnDelete();
            $table->timestamp('starts_at');
            $table->timestamp('ends_at');
            $table->enum('status', ['active', 'expired', 'grace'])->default('active');
            $table->string('razorpay_subscription_id')->nullable();
            $table->timestamps();

            $table->index(['institute_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
