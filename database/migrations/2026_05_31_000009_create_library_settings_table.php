<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('library_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->unique()->constrained()->cascadeOnDelete();
            $table->unsignedInteger('max_books_student')->default(3);
            $table->unsignedInteger('max_books_staff')->default(5);
            $table->unsignedInteger('max_borrow_days')->default(14);
            $table->decimal('fine_per_day', 8, 2)->default(2.00);
            $table->unsignedInteger('reservation_expiry_days')->default(3);
            $table->json('library_working_days')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('library_settings');
    }
};
