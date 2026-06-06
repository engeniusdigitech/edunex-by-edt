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
        Schema::create('vehicle_trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->foreignId('transport_route_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('scheduled'); // scheduled, en_route, completed
            $table->decimal('current_lat', 10, 8)->nullable();
            $table->decimal('current_lng', 11, 8)->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('student_boarding_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_trip_id')->constrained('vehicle_trips')->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('transport_stop_id')->constrained('transport_stops')->onDelete('cascade');
            $table->string('direction')->default('pickup'); // pickup, dropoff
            $table->string('status')->default('boarded'); // boarded, deboarded, absent
            $table->dateTime('logged_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_boarding_logs');
        Schema::dropIfExists('vehicle_trips');
    }
};
