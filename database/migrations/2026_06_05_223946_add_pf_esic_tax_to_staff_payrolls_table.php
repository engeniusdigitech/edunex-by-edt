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
        Schema::table('staff_payrolls', function (Blueprint $table) {
            $table->decimal('pf_deduction', 12, 2)->default(0.00)->after('deductions');
            $table->decimal('esic_deduction', 12, 2)->default(0.00)->after('pf_deduction');
            $table->decimal('tds_deduction', 12, 2)->default(0.00)->after('esic_deduction');
            $table->integer('paid_leaves_used')->default(0)->after('working_days');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff_payrolls', function (Blueprint $table) {
            $table->dropColumn(['pf_deduction', 'esic_deduction', 'tds_deduction', 'paid_leaves_used']);
        });
    }
};
