<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('library_digital_resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->foreignId('book_id')->nullable()->constrained('library_books')->nullOnDelete();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('file_path');
            $table->enum('file_type', ['pdf', 'docx', 'ppt', 'epub', 'other']);
            $table->unsignedBigInteger('file_size')->nullable();
            $table->boolean('is_downloadable')->default(true);
            $table->json('access_roles')->nullable();
            $table->unsignedInteger('download_count')->default(0);
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('library_digital_resources');
    }
};
