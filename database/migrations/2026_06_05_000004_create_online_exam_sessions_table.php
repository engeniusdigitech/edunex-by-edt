<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('online_exam_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('online_exam_id')->constrained()->cascadeOnDelete();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->dateTime('started_at');
            $table->dateTime('submitted_at')->nullable();
            $table->decimal('score', 8, 2)->nullable();
            $table->integer('total_marks')->default(0);
            $table->decimal('percentage', 5, 2)->nullable();
            $table->boolean('is_passed')->nullable();
            $table->integer('tab_switch_count')->default(0);
            $table->enum('status', ['in_progress', 'submitted', 'timed_out'])->default('in_progress');
            $table->timestamps();

            $table->unique(['online_exam_id', 'student_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('online_exam_sessions');
    }
};
