<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('online_exam_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('online_exam_id')->constrained()->cascadeOnDelete();
            $table->foreignId('question_bank_id')->nullable()->constrained()->nullOnDelete();
            $table->text('question');
            $table->string('option_a');
            $table->string('option_b');
            $table->string('option_c')->nullable();
            $table->string('option_d')->nullable();
            $table->enum('correct_option', ['a', 'b', 'c', 'd']);
            $table->integer('marks')->default(1);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('online_exam_questions');
    }
};
