<?php

namespace Database\Seeders;

use App\Models\Languages;
use App\Models\Meal;
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
        $languages = Languages::all();
        $fakeData = PhpFaker::create();
        $meals = Meal::all();
        $languageIds = DB::table('languages')->pluck('id')->toArray();

        foreach ($meals as $meal){
            foreach($languages as $language){
                $nameTranslation = $meal->translateOrNew($language->name)->name ?: $fakeData->word();
                $descriptionTranslation = $meal->translateOrNew($language->name)->description ?: $fakeData->word();
                $status = $meal->status;
                $mealId = $meal->id;

                DB::table('meal_translations')->insert([
                    'description' => $descriptionTranslation,
                    'status' => $status,
                    'name' => $nameTranslation,
                    'language_id' => $fakeData->numberBetween(min($languageIds), max($languageIds)),
                    'meal_id' => $mealId,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
    
}
