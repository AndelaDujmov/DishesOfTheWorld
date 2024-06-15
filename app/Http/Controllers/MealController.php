<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\MealTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MealController extends Controller
{
    public function index(Request $request)
    {
    
        $lang = $request->input('lang');
        
        if (!$lang) {
            return response()->json(['error' => 'Lang parameter required'], 400);
        }

        $elementsPerPage = $request->input('per_page');
        $page = $request ->input('page');
        $diffTime = $request->input('diff_time');
        
        $query = Meal::query();

        $category = $request->input('category');

        $tags = $request->query('tags');
        if ($tags) {
           
            if (is_string($tags)) {
                $tagIds = explode(',', $tags);
            } else if (is_array($tags)) {
                $tagIds = $tags;
            } else {
                $tagIds = [];
            }
            if (!empty($tagIds)) {
                $query->whereHas('tags', function ($q) use ($tagIds) {
                    $q->whereIn('meal_tag.tag_id', $tagIds);
                });
            }
        }   

        $ingredients = $request->query('ingredients');
        if ($ingredients) {
           
            if (is_string($ingredients)) {
                $ingredientsId = explode(',', $ingredients);
            } else if (is_array($ingredients)) {
                $ingredientsId = $ingredients;
            } else {
                $ingredientsId = [];
            }

            $query->whereHas('ingredients', function ($q) use ($ingredientsId) {
                $q->whereIn('meal_ingredient.ingredient_id', $ingredientsId);
            });
        }
 /*
        $listOfLanguages = $request->query('languages');
        if ($listOfLanguages) {
           
            if (is_string($listOfLanguages)) {
                $languagesId = explode(',', $listOfLanguages);
            } else if (is_array($listOfLanguages)) {
                $languagesId = $listOfLanguages;
            } else {
                $languagesId = [];
            }

           
            $query->whereHas('languages', function ($q) use ($languagesId) {
                $q->whereIn('meal_.ingredient_id', $languagesId);
            }, '=', count($ingredientsId));
        }*/

        if ($category !== null) {
            if ($category === '!NULL') {
                $query->whereNotNull('category_id');
            } else if ($category === 'NULL') {
                $query->whereNull('category_id');
            } else {
                $query->where('category_id', "=", intval($category));
            }
        }

        if ($diffTime && is_numeric($diffTime) && $diffTime > 0) {
            $query->where('created_at', '>=', now()->subSeconds($diffTime))
                  ->orWhere('updated_at', '>=', now()->subSeconds($diffTime))
                  ->orWhere('deleted_at', '>=', now()->subSeconds($diffTime));
        }


        $with = $request->input('with', []); 
        if (!empty($with)) {
            $relationships = explode(',', $with);
            $query->with($relationships);
        }
       /* $query->with(['translations' => function ($q) use ($languageId) {
            $q->where('language_id', $languageId);
        }]);*/

      
        $with = $request->input('with', []);
        if (!empty($with)) {
            $relationships = explode(',', $with);
            $query->with($relationships);
        }
        $meal = $query->paginate($elementsPerPage, ['*'], 'page', $page);
    /*
        foreach ($meal as $meal) {
            $translation = $meal->translations->first();
            if ($translation) {
                $meal->name = $translation->name;
                $meal->description = $translation->description;
            }
        }
        */

        $data = [
            'names' => $meal
        ];

        return response()->json($data);
    }
}
