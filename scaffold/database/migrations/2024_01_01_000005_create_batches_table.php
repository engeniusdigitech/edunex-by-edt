<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('schedule_time')->nullable(); // e.g. Mon-Wed-Fri 10AM
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['institute_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
