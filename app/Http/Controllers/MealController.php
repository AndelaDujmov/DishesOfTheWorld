<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\MealTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MealController extends Controller
{
    public function index(Request $request){
    
        $lang = $request->input('lang');
       
        app()->setLocale($lang);

        $languageId = DB::table('languages')
                    ->where('name', $lang)
                    ->value('id');


        $elementsPerPage = $request->input('per_page');
        $page = $request ->input('page');
        $diffTime = $request->input('diff_time');

        $query = Meal::query();

        if ($diffTime > 0){
            $query->where('created_at', '>=', now()->subSeconds($diffTime))
                  ->orWhere('updated_at', '>=', now()->subSeconds($diffTime));
        }

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

            $query->whereHas('tags', function ($q) use ($tagIds) {
                $q->whereIn('meal_tag.tag_id', $tagIds);
            }, '=', count($tagIds));
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
            }, '=', count($ingredientsId));
        }


        if ($category !== null) {
            if ($category === '!NULL') {
                $query->whereNotNull('category_id');
            } else if ($category === 'NULL') {
                $query->whereNull('category_id');
            } else {
                $query->where('category_id', "=", intval($category));
            }
        }
        $meal = $query->paginate($elementsPerPage, ['*'], 'page', $page);
    
        foreach ($meal as $element) {
            $translation = MealTranslation::where('meal_id', $element->id)
                                          ->where('language_id', $languageId)
                                          ->first();
    
            if ($translation) {
                $element->name = $translation->name;
                $element->description = $translation->description;
            }
        }
    

        return response()->json($meal);
    }
}
