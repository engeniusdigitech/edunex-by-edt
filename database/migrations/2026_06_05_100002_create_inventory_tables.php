<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inventory_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('sku')->nullable();
            $table->string('unit')->default('pcs');
            $table->integer('available_qty')->default(0);
            $table->integer('min_qty_warning')->default(5);
            $table->decimal('unit_price', 10, 2)->default(0.00);
            $table->timestamps();
        });

        Schema::create('inventory_suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('contact_person')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });

        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->string('po_number')->unique();
            $table->foreignId('inventory_supplier_id')->constrained()->cascadeOnDelete();
            $table->date('order_date');
            $table->date('delivery_date')->nullable();
            $table->decimal('total_amount', 10, 2)->default(0.00);
            $table->enum('status', ['draft', 'sent', 'received', 'cancelled'])->default('draft');
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('inventory_item_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity');
            $table->decimal('unit_cost', 10, 2);
            $table->decimal('total_cost', 10, 2);
            $table->timestamps();
        });

        Schema::create('inventory_stock_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_item_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['stock_in', 'stock_out']);
            $table->integer('quantity');
            $table->string('reference')->nullable();
            $table->foreignId('logged_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_stock_logs');
        Schema::dropIfExists('purchase_order_items');
        Schema::dropIfExists('purchase_orders');
        Schema::dropIfExists('inventory_suppliers');
        Schema::dropIfExists('inventory_items');
        Schema::dropIfExists('inventory_categories');
    }
};
