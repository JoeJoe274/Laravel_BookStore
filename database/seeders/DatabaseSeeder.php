<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CreateBooksTableSeeder::class);
        $this->call(CreateBookReviewsSeeder::class);
        $this->call(CreateCustomersSeeder::class);
        $this->call(CreateOrderDetailsSeeder::class);
        $this->call(CreateOrdersSeeder::class);
        $this->call(UserSeeder::class);
    }
}
