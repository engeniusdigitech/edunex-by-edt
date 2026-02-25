<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('fee_structure_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('amount_paid', 10, 2);
            $table->date('payment_date');
            $table->enum('payment_method', ['cash', 'online', 'bank_transfer'])->default('cash');
            $table->string('razorpay_payment_id')->nullable();
            $table->enum('status', ['success', 'failed', 'pending'])->default('success');
            $table->timestamps();

            $table->index(['institute_id', 'student_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
