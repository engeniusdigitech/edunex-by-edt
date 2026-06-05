<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('online_exam_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('online_exam_session_id')->constrained()->cascadeOnDelete();
            $table->foreignId('online_exam_question_id')->constrained()->cascadeOnDelete();
            $table->enum('selected_option', ['a', 'b', 'c', 'd'])->nullable();
            $table->boolean('is_correct')->nullable();
            $table->timestamps();

            $table->unique(['online_exam_session_id', 'online_exam_question_id'], 'exam_answers_session_q_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('online_exam_answers');
    }
};
