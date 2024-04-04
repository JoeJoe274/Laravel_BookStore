<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateBookReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker=\faker\factory::create();
        for($i=0; $i<50; $i++){
            DB::table('book_reviews')->insert([
                'book_id'=>$faker->numberBetween($min=1, $max=50),
                'description'=>$faker->text(100),
                'created_at'=>$faker->dateTime($max='now', $timezone=null),
                'updated_at'=>$faker->dateTime($max='now', $timezone=null)
            ]);
        }
    }
}
