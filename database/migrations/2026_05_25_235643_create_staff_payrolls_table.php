<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff_payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('month');
            $table->unsignedSmallInteger('year');
            $table->decimal('basic_salary', 12, 2);
            $table->decimal('hra', 12, 2)->default(0);
            $table->decimal('allowances', 12, 2)->default(0);
            $table->decimal('deductions', 12, 2)->default(0);
            $table->decimal('gross_salary', 12, 2);
            $table->decimal('net_salary', 12, 2);
            $table->unsignedTinyInteger('present_days')->default(0);
            $table->unsignedTinyInteger('working_days')->default(0);
            $table->enum('status', ['draft', 'processed', 'paid'])->default('draft');
            $table->date('paid_at')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('generated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(['user_id', 'month', 'year']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff_payrolls');
    }
};
