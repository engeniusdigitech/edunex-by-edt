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
        Schema::table('visitors', function (Blueprint $table) {
            $table->dateTime('check_in_time')->nullable()->change();
            $table->string('status')->default('pending')->change(); // change default status to pending
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dateTime('check_in_time')->nullable(false)->change();
            $table->string('status')->default('checked_in')->change();
        });
    }
};
