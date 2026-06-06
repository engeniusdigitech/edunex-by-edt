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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->string('pass_number')->unique();
            $table->string('visitor_name');
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->string('purpose');
            $table->foreignId('whom_to_meet_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('whom_to_meet_name')->nullable();
            $table->string('gate_number');
            $table->string('vehicle_number')->nullable();
            $table->string('id_proof_type');
            $table->string('id_proof_number')->nullable();
            $table->dateTime('check_in_time');
            $table->dateTime('check_out_time')->nullable();
            $table->string('status')->default('checked_in'); // checked_in, checked_out
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
