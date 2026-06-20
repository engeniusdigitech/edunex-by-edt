<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('institutes', function (Blueprint $table) {
            $table->boolean('feature_attendance')->default(true)->after('feature_whatsapp');
            $table->boolean('feature_academics')->default(true)->after('feature_attendance');
            $table->boolean('feature_lms')->default(true)->after('feature_academics');
            $table->boolean('feature_exams')->default(true)->after('feature_lms');
            $table->boolean('feature_curriculum')->default(true)->after('feature_exams');
            $table->boolean('feature_reports')->default(true)->after('feature_curriculum');
        });
    }

    public function down(): void
    {
        Schema::table('institutes', function (Blueprint $table) {
            $table->dropColumn([
                'feature_attendance',
                'feature_academics',
                'feature_lms',
                'feature_exams',
                'feature_curriculum',
                'feature_reports',
            ]);
        });
    }
};

