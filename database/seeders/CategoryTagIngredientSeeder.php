<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as PhpFaker;

class CategoryTagIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedData('category', 20);
        $this->seedData('tags', 15);
        $this->seedData('ingredients', 15);
    }

    private function seedData($table, $len){
        $fakeData = PhpFaker::create();

        foreach(range(1, $len) as $i){
            DB::table($table)->insert([
                'title' => $fakeData->word,
                'slug' => $fakeData->slug
            ]);
        }
    }
}
 