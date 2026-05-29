<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('blood_group', 5)->nullable()->after('phone');
            $table->string('alternate_phone_1', 20)->nullable()->after('blood_group');
            $table->string('alternate_phone_2', 20)->nullable()->after('alternate_phone_1');
            $table->string('parent_email')->nullable()->after('alternate_phone_2');
            $table->string('father_name')->nullable()->after('parent_email');
            $table->string('mother_name')->nullable()->after('father_name');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['blood_group', 'alternate_phone_1', 'alternate_phone_2', 'parent_email', 'father_name', 'mother_name']);
        });
    }
};
