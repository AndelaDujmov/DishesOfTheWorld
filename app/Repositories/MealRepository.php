<?php

namespace App\Repositories;

use App\Models\Meal;
use Illuminate\Support\Facades\DB;

class MealRepository implements MealRepositoryInterface
{
    public function getLanguagesByLocale($locale)
    {
        return DB::table('languages')->select('id')
                                     ->where('name', $locale)
                                     ->first();
    }

    public function queryMeal(){
        return Meal::query();
    }

    public function returnMealsWithTag($query, $tagIds)
    {
        return $query->whereHas('tags', function ($q) use ($tagIds){
                  $q->whereIn('meal_tag.tag_id', $tagIds);
        });
    }

    public function returnMealsWithIngredients($query, $ingredientsId)
    {
        return $query->whereHas('ingredients', function ($q) use ($ingredientsId) {
            $q->whereIn('ingredients.id', $ingredientsId);  
        });
    }

    public function returnMealWithCategory($query, $categoryId)
    {
        if ($categoryId === '!NULL') {
            return $query->whereNotNull('category_id');
        } else if ($categoryId === 'NULL') {
            return $query->whereNull('category_id');
        } else {
            return $query->where('category_id', "=", ($categoryId)); //intval
        }
    }

    public function getAllMealsModifiedAt($query, $diffTime)
    {
        return $query->where(function ($q) use ($diffTime){
                   $q->where('meal.created_at', '>=', now()->subSeconds($diffTime))
                     ->orWhere('meal.updated_at', '>=', now()->subSeconds($diffTime))
                     ->orWhere('meal.deleted_at', '>=', now()->subSeconds($diffTime));
        });
    }

    public function translateMeals($query, $language)
    {
        return $query->select('meal.id', 
                              'meal.category_id', 
                              'meal.created_at', 
                              'meal.updated_at', 
                              'meal.status', 
                              'meal.deleted_at',
                              'meal_translations.name', 
                              'meal_translations.description')
                     ->leftJoin('meal_translations', function ($join) use ($language) { 
                              $join->on('meal.id', '=', 'meal_translations.meal_id')
                     ->where('meal_translations.language_id', '=', $language->id);
        })
        ->with(['ingredients' => function ($q){
            $q->select('ingredients.id', 'ingredients.title');
        }])
        ->with(['tags' => function($q){
            $q->select('tags.id', 'tags.title');
        }])
        ->with(['category' => function($q){
            $q->select('category.id', 'category.title');
        }]);
    }
}   