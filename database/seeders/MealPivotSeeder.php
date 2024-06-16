<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as PhpFaker;

class MealPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredients = DB::table('ingredients')->pluck('id')->toArray();
        $tags = DB::table('tags')->pluck('id')->toArray();
        $meals = DB::table('meal')->pluck('id')->toArray();
        $fakeData = PhpFaker::create();
     


        foreach ($meals as $mealId) {

            
           for ($i=0;$i<$fakeData->numberBetween(1, 20); $i++){
                DB::table('meal_ingredient')->insert([
                    'ingredient_id' => $fakeData->numberBetween(min($ingredients), max($ingredients)),
                    'meal_id' => $mealId
                ]);

                DB::table('meal_tag')->insert([
                    'tag_id' => $fakeData->numberBetween(min($tags), max($tags)),
                    'meal_id' => $mealId
                ]);
           }
    
        }


        }
    }