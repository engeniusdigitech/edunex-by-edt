<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::table('live_lectures', function (Blueprint $table) {
            // Add a unique room name per lecture for Jitsi Meet
            $table->string('room_name')->nullable()->after('batch_id');
            // 'scheduled', 'live', 'ended'
            $table->enum('status', ['scheduled', 'live', 'ended'])->default('scheduled')->after('room_name');
            // Make video_path and recorded_at nullable since they are no longer required upfront
            $table->string('video_path')->nullable()->change();
            $table->date('recorded_at')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('live_lectures', function (Blueprint $table) {
            $table->dropColumn(['room_name', 'status']);
            $table->string('video_path')->nullable(false)->change();
            $table->date('recorded_at')->nullable(false)->change();
        });
    }
};
