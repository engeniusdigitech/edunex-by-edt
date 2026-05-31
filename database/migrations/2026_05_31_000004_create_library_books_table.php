<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('library_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('library_categories')->nullOnDelete();
            $table->foreignId('author_id')->nullable()->constrained('library_authors')->nullOnDelete();
            $table->foreignId('publisher_id')->nullable()->constrained('library_publishers')->nullOnDelete();
            $table->string('title', 255);
            $table->string('isbn', 50)->nullable();
            $table->string('edition', 100)->nullable();
            $table->string('language', 100)->default('English');
            $table->string('rack_number', 50)->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('total_copies')->default(1);
            $table->unsignedInteger('available_copies')->default(1);
            $table->string('cover_image')->nullable();
            $table->string('barcode')->nullable();
            $table->string('qr_data')->nullable();
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['institute_id', 'isbn']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('library_books');
    }
};
