<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->foreignId('batch_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('profile_image')->nullable();
            $table->date('enrollment_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['institute_id', 'batch_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
