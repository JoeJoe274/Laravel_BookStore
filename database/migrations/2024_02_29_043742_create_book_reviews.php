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
        if (!Schema::hasTable('book_reviews')) {
            Schema::create('book_reviews', function (Blueprint $table) {
                $table->id();
                $table->integer('book_id');
                $table->string('description');
                $table->dateTime('deleted_at')->nullable();
                $table->dateTime('created_at');
                $table->dateTime('updated_at');
                $table->index('book_id', 'book_id_idx');
                $table->index('deleted_at', 'idx_book_reviews_deleted_at');
                $table->index('created_at', 'idx_book_reviews_created_at');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_reviews');
    }
};
