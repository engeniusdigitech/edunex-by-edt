<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('institutes', function (Blueprint $table) {
            $table->text('address')->nullable()->after('phone');
            $table->decimal('latitude', 10, 7)->nullable()->after('address');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            $table->unsignedInteger('attendance_radius_meters')->default(100)->after('longitude');
        });
    }

    public function down(): void
    {
        Schema::table('institutes', function (Blueprint $table) {
            $table->dropColumn(['address', 'latitude', 'longitude', 'attendance_radius_meters']);
        });
    }
};
