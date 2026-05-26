<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->timestamp('mark_in_at')->nullable();
            $table->timestamp('mark_out_at')->nullable();
            $table->decimal('mark_in_latitude', 10, 7)->nullable();
            $table->decimal('mark_in_longitude', 10, 7)->nullable();
            $table->decimal('mark_out_latitude', 10, 7)->nullable();
            $table->decimal('mark_out_longitude', 10, 7)->nullable();
            $table->unsignedInteger('mark_in_distance_meters')->nullable();
            $table->unsignedInteger('mark_out_distance_meters')->nullable();
            $table->boolean('face_verified_in')->default(false);
            $table->boolean('face_verified_out')->default(false);
            $table->enum('status', ['present', 'half_day', 'absent'])->default('absent');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff_attendances');
    }
};
