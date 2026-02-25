<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('fee_structures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->string('name'); // e.g. "Class 10 Annual Fee"
            $table->decimal('total_amount', 10, 2);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['institute_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_structures');
    }
};
