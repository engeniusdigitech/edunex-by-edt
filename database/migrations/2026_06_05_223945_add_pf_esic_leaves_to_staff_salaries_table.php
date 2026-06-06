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
        Schema::table('staff_salaries', function (Blueprint $table) {
            $table->decimal('pf_rate', 5, 2)->default(0.00)->after('deductions');
            $table->decimal('esic_rate', 5, 2)->default(0.00)->after('pf_rate');
            $table->integer('cl_allowance')->default(0)->after('esic_rate');
            $table->integer('el_allowance')->default(0)->after('cl_allowance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff_salaries', function (Blueprint $table) {
            $table->dropColumn(['pf_rate', 'esic_rate', 'cl_allowance', 'el_allowance']);
        });
    }
};
