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
        Schema::create('test_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->onDelete('cascade');
            $table->foreignId('test_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->decimal('score', 8, 2);
            $table->text('remarks')->nullable();
            $table->timestamps();

            // Prevent duplicate score entries for the same student and test
            $table->unique(['test_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_scores');
    }
};
