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
        if (!Schema::hasTable('books')) {
            Schema::create('books', function (Blueprint $table) {
                $table->id();
                $table->string('ISBN', 100);
                $table->string('author', 100);
                $table->string('title', 100);
                $table->double('price');
                $table->string('cover_url', 100)->nullable();
                $table->dateTime('deleted_at')->nullable();
                $table->dateTime('created_at');
                $table->dateTime('updated_at');
                $table->index('ISBN', 'idx_books_ISBN');
                $table->index('author', 'idx_books_author');
                $table->index('title', 'idx_books_title');
                $table->index('price', 'idx_books_price');
                $table->index('deleted_at', 'idx_books_deleted_at');
                $table->index('created_at', 'idx_books_created_at');

            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
