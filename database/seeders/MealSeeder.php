<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as PhpFaker;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fakeData = PhpFaker::create();

        foreach(range(1, 20) as $i){
            DB::table('meal')->insert([
                'name' => $fakeData->sentence(2),
                'category_id' => $fakeData->numberBetween(1, 20)
            ]);
        }
    }

  

}
