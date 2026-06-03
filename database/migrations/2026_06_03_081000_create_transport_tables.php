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
        // 1. Vehicles table
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->onDelete('cascade');
            $table->string('vehicle_number');
            $table->string('vehicle_name');
            $table->integer('capacity');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Transport Routes table
        Schema::create('transport_routes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->onDelete('cascade');
            $table->string('route_name');
            $table->text('route_description')->nullable();
            $table->decimal('fee', 10, 2)->default(0.00);
            $table->timestamps();
        });

        // 3. Transport Stops table
        Schema::create('transport_stops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->onDelete('cascade');
            $table->string('stop_name');
            $table->foreignId('transport_route_id')->constrained('transport_routes')->onDelete('cascade');
            $table->timestamps();
        });

        // 4. Drivers table
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->onDelete('cascade');
            $table->string('driver_name');
            $table->string('mobile_number');
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles')->onDelete('set null');
            $table->timestamps();
        });

        // 5. Student Transport Allocations table
        Schema::create('student_transport_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('transport_route_id')->constrained('transport_routes')->onDelete('cascade');
            $table->foreignId('transport_stop_id')->constrained('transport_stops')->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $table->string('fee_status')->default('Pending'); // Paid or Pending
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_transport_allocations');
        Schema::dropIfExists('drivers');
        Schema::dropIfExists('transport_stops');
        Schema::dropIfExists('transport_routes');
        Schema::dropIfExists('vehicles');
    }
};
