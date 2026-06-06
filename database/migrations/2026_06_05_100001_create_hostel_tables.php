<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hostels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->enum('type', ['boys', 'girls', 'mixed'])->default('mixed');
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('hostel_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hostel_id')->constrained()->cascadeOnDelete();
            $table->string('room_number');
            $table->string('room_type')->default('Double');
            $table->integer('capacity')->default(2);
            $table->decimal('cost_per_month', 10, 2)->default(0.00);
            $table->timestamps();
        });

        Schema::create('hostel_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('hostel_room_id')->constrained()->cascadeOnDelete();
            $table->date('allocated_from');
            $table->date('allocated_to')->nullable();
            $table->enum('status', ['active', 'completed', 'cancelled'])->default('active');
            $table->timestamps();
        });

        Schema::create('hostel_messes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('warden_name')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('mess_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hostel_mess_id')->constrained()->cascadeOnDelete();
            $table->enum('day_of_week', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
            $table->enum('meal_type', ['breakfast', 'lunch', 'snacks', 'dinner']);
            $table->text('menu_items');
            $table->timestamps();
            
            $table->unique(['hostel_mess_id', 'day_of_week', 'meal_type'], 'mess_menu_schedule_unique');
        });

        Schema::create('student_mess_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('hostel_mess_id')->constrained()->cascadeOnDelete();
            $table->date('start_date');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        Schema::create('hostel_bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->decimal('paid_amount', 10, 2)->default(0.00);
            $table->decimal('due_amount', 10, 2);
            $table->date('billing_month');
            $table->enum('status', ['unpaid', 'partially_paid', 'paid'])->default('unpaid');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hostel_bills');
        Schema::dropIfExists('student_mess_subscriptions');
        Schema::dropIfExists('mess_menus');
        Schema::dropIfExists('hostel_messes');
        Schema::dropIfExists('hostel_allocations');
        Schema::dropIfExists('hostel_rooms');
        Schema::dropIfExists('hostels');
    }
};
