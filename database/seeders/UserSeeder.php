<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            DB::table('users')->insert([
                'name'      => $faker->firstNameMale(),
                'email'       => $faker->unique()->safeEmail,
                'email_verified_at'       => now(),
                'password'   => '123',
                'remember_token'   => Str::random(10),
                'created_at'  => $faker->dateTime($max = 'now', $timezone = null),
                'updated_at'  => $faker->dateTime($max = 'now', $timezone = null)
            ]);
        }
    }
}
