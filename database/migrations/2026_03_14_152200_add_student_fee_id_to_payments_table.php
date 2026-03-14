<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('student_fee_id')->nullable()->after('fee_structure_id')->constrained('student_fees')->nullOnDelete();
        });

        // Backfill existing payments
        $payments = DB::table('payments')->get();
        foreach ($payments as $payment) {
            $studentFee = DB::table('student_fees')
                ->where('student_id', $payment->student_id)
                ->where('fee_structure_id', $payment->fee_structure_id)
                ->first();

            if ($studentFee) {
                DB::table('payments')
                    ->where('id', $payment->id)
                    ->update(['student_fee_id' => $studentFee->id]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['student_fee_id']);
            $table->dropColumn('student_fee_id');
        });
    }
};
