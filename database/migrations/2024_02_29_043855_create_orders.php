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
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->integer('customer_id');
                $table->double('amount');
                $table->dateTime('date');
                $table->dateTime('deleted_at')->nullable();
                $table->dateTime('created_at');
                $table->dateTime('updated_at');
                $table->index('customer_id', 'customer_id_idx');
                $table->index('date', 'idx_order_date');
                $table->index('deleted_at', 'idx_order_deleted_at');
                $table->index('created_at', 'idx_order_created_at');
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
