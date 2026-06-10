<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('institutes', function (Blueprint $table) {
            $table->boolean('feature_visitor')->default(true)->after('feature_hr');
            $table->boolean('feature_accounting')->default(true)->after('feature_fees');
            $table->boolean('feature_inventory')->default(true)->after('feature_accounting');
            $table->boolean('feature_hostel')->default(true)->after('feature_inventory');
            $table->boolean('feature_library')->default(true)->after('feature_hostel');
            $table->boolean('feature_transport')->default(true)->after('feature_library');
            $table->boolean('feature_whatsapp')->default(true)->after('feature_transport');
        });
    }

    public function down(): void
    {
        Schema::table('institutes', function (Blueprint $table) {
            $table->dropColumn([
                'feature_visitor',
                'feature_accounting',
                'feature_inventory',
                'feature_hostel',
                'feature_library',
                'feature_transport',
                'feature_whatsapp',
            ]);
        });
    }
};

