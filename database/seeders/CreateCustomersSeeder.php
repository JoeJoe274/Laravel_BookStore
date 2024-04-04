<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateCustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker=\faker\factory::create();
        for($i=0; $i<50; $i++){
            DB::table('customers')->insert([
                'name'=>$faker->firstNameMale,
                'address'=>$faker->text(50),
                'city'=>$faker->text(10),
                'created_at'=>$faker->dateTime($max='now', $timezone=null),
                'updated_at'=>$faker->dateTime($max='now', $timezone=null)
            ]);
    }
    }
}
