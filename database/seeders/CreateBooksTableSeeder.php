<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateBooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker=\faker\factory::create();
        for($i=0; $i<50; $i++){
            DB::table('books')->insert([
                'ISBN'=>$faker->isbn13('-'),
                'author'=>$faker->firstNameMale,
                'title'=>$faker->catchPhrase,
                'price'=>$faker->randomNumber(2),
                'cover_url'=>'http://loream.com',
                'created_at'=>$faker->dateTime($max='now', $timezone=null),
                'updated_at'=>$faker->dateTime($max='now', $timezone=null)
            ]);
        }
    }
}
