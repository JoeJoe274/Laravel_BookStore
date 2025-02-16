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
        if (!Schema::hasTable('customers')) {
            Schema::create('customers', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100);
                $table->string('address')->nullable();
                $table->string('city', 100)->nullable();
                $table->dateTime('deleted_at')->nullable();
                $table->dateTime('created_at');
                $table->dateTime('updated_at');
                $table->index('name', 'idx_customers_name');
                $table->index('deleted_at', 'idx_customers_deleted_at');
                $table->index('created_at', 'idx_customers_created_at');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
