<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as PhpFaker;

class LanguagePivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fakeData = PhpFaker::create();

        $languages = DB::table('languages')->pluck('id')->toArray();
        $ingredients = DB::table('ingredients')->pluck('id')->toArray();
        $tags = DB::table('tags')->pluck('id')->toArray();
        $categories = DB::table('category')->pluck('id')->toArray();

        foreach ($categories as $categoryId) {
            
            $languageId = $languages[array_rand($languages)];

            DB::table('languages_category')->insert([
                'language_id' => $languageId,
                'category' => $categoryId
            ]);
        }
        

        foreach ($languages as $languageId) {
            foreach ($tags as $tagId) {
                DB::table('languages_tag')->insert([
                    'language_id' => $fakeData->numberBetween(min($languages), max($languages)),
                    'tag_id' => $fakeData->numberBetween(min($tags), max($tags))
                ]);
            }
        }

        
        foreach ($languages as $languageId) {
            foreach ($ingredients as $ingredientId) {
                DB::table('languages_ingredient')->insert([
                    'language_id' => $fakeData->numberBetween(min($languages), max($languages)),
                    'ingredient_id' => $fakeData->numberBetween(min($ingredients), max($ingredients))
                ]);
            }
        }
    }

}
