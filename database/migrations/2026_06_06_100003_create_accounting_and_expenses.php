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
        Schema::create('accounting_ledgers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('type'); // asset, liability, equity, revenue, expense
            $table->string('code')->nullable();
            $table->boolean('is_system')->default(false);
            $table->timestamps();
            
            $table->unique(['institute_id', 'name']);
        });

        Schema::create('accounting_vouchers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->onDelete('cascade');
            $table->string('voucher_number')->unique();
            $table->string('type'); // receipt, payment, journal
            $table->date('date');
            $table->string('narration')->nullable();
            $table->decimal('amount', 15, 2);
            $table->nullableMorphs('reference');
            $table->timestamps();
        });

        Schema::create('accounting_journal_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('accounting_voucher_id')->constrained('accounting_vouchers')->onDelete('cascade');
            $table->foreignId('accounting_ledger_id')->constrained('accounting_ledgers')->onDelete('cascade');
            $table->string('entry_type'); // debit, credit
            $table->decimal('amount', 15, 2);
            $table->timestamps();
        });

        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->onDelete('cascade');
            $table->foreignId('accounting_ledger_id')->constrained('accounting_ledgers')->onDelete('cascade');
            $table->foreignId('supplier_id')->nullable()->constrained('inventory_suppliers')->onDelete('set null');
            $table->date('expense_date');
            $table->decimal('net_amount', 15, 2);
            $table->decimal('gst_rate', 5, 2)->default(0.00);
            $table->string('gst_type')->default('none'); // cgst_sgst, igst, none
            $table->decimal('gst_amount', 15, 2)->default(0.00);
            $table->decimal('total_amount', 15, 2);
            $table->string('payment_method'); // Cash, Bank, Card
            $table->string('reference_no')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('accounting_journal_entries');
        Schema::dropIfExists('accounting_vouchers');
        Schema::dropIfExists('accounting_ledgers');
    }
};
