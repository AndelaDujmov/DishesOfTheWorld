<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as PhpFaker;

class PivotTablesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedPivot('meal_ingredient', 12, 15);
        $this->seedPivot('meal_tag', 20, 15);
    }

    private function seedPivot($table, $len, $lenPivot){
        $fakeData = PhpFaker::create();
        $columnName = ($table == 'meal_tag') ? 'tag_id' : 'ingredient_id';

        foreach(range(1, $len) as $i){
            DB::table($table)->insert([
                $columnName => $fakeData->numberBetween(1, $lenPivot),
                'meal_id' => $fakeData->numberBetween(1, 20)
            ]);
        }
    }
}
