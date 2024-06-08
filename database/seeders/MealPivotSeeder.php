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
        $ingredientId = $ingredients[array_rand($ingredients)];
        $tagId = $tags[array_rand($tags)];
        $fakeData = PhpFaker::create();


        foreach ($meals as $mealId) {

            DB::table('meal_ingredient')->insert([
                'ingredient_id' => $fakeData->numberBetween(min($ingredients), max($ingredients)),
                'meal_id' => $fakeData->numberBetween(min($meals), max($meals))
            ]);

            DB::table('meal_tag')->insert([
                'tag_id' => $fakeData->numberBetween(min($tags), max($tags)),
                'meal_id' => $fakeData->numberBetween(min($meals), max($meals))
            ]);
        }

    

        }
    }