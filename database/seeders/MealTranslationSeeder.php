<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as PhpFaker;

class MealTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = DB::table('languages')->pluck('name')->toArray();;
        $fakeData = PhpFaker::create();
        $meals =  DB::table('meal')->get();
        $languageIds = DB::table('languages')->pluck('id')->toArray();
      
        foreach ($meals as $meal){
            var_dump($meal);
            foreach($languages as $language){
                DB::table('meal_translations')->insert([
                    'description' => $fakeData->sentence(4),
                    'status' => $meal->status,
                    'name' => $fakeData->sentence(2),
                    'language_id' => $fakeData->numberBetween(min($languageIds), max($languageIds)),
                    'meal_id' => $meal->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
    
}
