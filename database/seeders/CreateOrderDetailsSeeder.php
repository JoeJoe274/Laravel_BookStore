<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateOrderDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker=\faker\factory::create();
        for($i=0; $i<50; $i++){
            DB::table('order_details')->insert([
                'order_id'=>$faker->numberBetween($min=1, $max=50),
                'book_id'=>$faker->numberBetween($min=1, $max=50),
                'qty'=>$faker->randomNumber(1),
                'created_at'=>$faker->dateTime($max='now', $timezone=null),
                'updated_at'=>$faker->dateTime($max='now', $timezone=null)
            ]);
    }
}

}
