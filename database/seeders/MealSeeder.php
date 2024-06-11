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
        $categories = DB::table('category')->pluck('id')->toArray();
        
        if (DB::table('meal')->count() == 0){
            foreach (range(1, count($categories)) as $i) {
                DB::table('meal')->insert([
                    'name' => $fakeData->sentence(2),
                    'description' => $fakeData->sentence(4),
                    'status' =>'created',
                    'category_id' => $fakeData->numberBetween(min($categories), max($categories)),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
        else{
            foreach (range(1, count($categories)) as $i) {
                DB::table('meal')->update([
                    'status' =>'updated',
                    'updated_at' => now()
                ]);
            }
        }
    }
}
