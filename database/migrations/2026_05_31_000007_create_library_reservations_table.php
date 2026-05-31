<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('library_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->foreignId('book_id')->constrained('library_books')->cascadeOnDelete();
            $table->unsignedBigInteger('member_id');
            $table->string('member_type');
            $table->date('reservation_date');
            $table->date('expiry_date');
            $table->enum('status', ['pending', 'fulfilled', 'expired', 'cancelled'])->default('pending');
            $table->softDeletes();
            $table->timestamps();

            $table->index(['member_id', 'member_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('library_reservations');
    }
};
