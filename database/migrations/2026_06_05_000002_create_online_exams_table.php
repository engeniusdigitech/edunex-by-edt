<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('online_exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->foreignId('batch_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('instructions')->nullable();
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->integer('duration_minutes')->default(60);
            $table->integer('total_marks')->default(0);
            $table->integer('pass_percentage')->default(40);
            $table->boolean('shuffle_questions')->default(true);
            $table->boolean('show_result_immediately')->default(true);
            $table->boolean('allow_review')->default(true);
            $table->enum('status', ['draft', 'published', 'closed'])->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('online_exams');
    }
};
