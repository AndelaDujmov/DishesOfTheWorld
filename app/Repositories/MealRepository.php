<?php

namespace App\Repositories;

use App\Models\Meal;
use Illuminate\Support\Facades\DB;

class MealRepository implements MealRepositoryInterface
{
    public function getLanguagesByLocale($locale)
    {
        return DB::table('languages')->select('id')->where('name', $locale)->first();
    }

    public function getAllMeals()
    {
        Meal::all();
    }


}   