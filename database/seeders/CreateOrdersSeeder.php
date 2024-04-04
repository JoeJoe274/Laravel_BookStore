<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker=\faker\factory::create();
        for($i=0; $i<50; $i++){
            DB::table('orders')->insert([
                'customer_id'=>$faker->numberBetween($min=1, $max=50),
                'amount'=>$faker->randomNumber(2),
                'date'=>$faker->dateTime($max='now', $timezone=null),
                'created_at'=>$faker->dateTime($max='now', $timezone=null),
                'updated_at'=>$faker->dateTime($max='now', $timezone=null)
            ]);
    }
}

}
