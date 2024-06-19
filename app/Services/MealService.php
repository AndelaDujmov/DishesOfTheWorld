<?php

namespace App\Services;
use App\Repositories\MealRepositoryInterface;

class MealService implements MealServiceInterface {

    private MealRepositoryInterface $mealRepository;

    public function __construct(MealRepositoryInterface $mealRepo) {
        $this->mealRepository = $mealRepo;
    }

    public function filterMeals($request)
    {
        $languageId = $this->mealRepository->getLanguagesByLocale($request->input('lang'));;

        $elementsPerPage = $request->input('per_page');
        $page = $request->input('page');
        $diffTime = $request->input('diff_time');
        
        $query = $this->mealRepository->queryMeal();


        if ($diffTime && is_numeric($diffTime) && $diffTime > 0) {
            $query = $this->mealRepository->getAllMealsModifiedAt($query, $diffTime);
        }

        $category = $request->input('category');

        $tags = $request->input('tags');
        if ($tags) {
        
            if (is_string($tags)) {
                $tagIds = explode(',', $tags);
            } else if (is_array($tags)) {
                $tagIds = $tags;
            } else {
                $tagIds = [];
            }
            if (!empty($tagIds)) {
                $query = $this->mealRepository->returnMealsWithTag($query, $tagIds);
            }
        }   

        $ingredients = $request->input('ingredients');
        if ($ingredients) {
        
            if (is_string($ingredients)) {
                $ingredientsId = explode(',', $ingredients);
            } else if (is_array($ingredients)) {
                $ingredientsId = $ingredients;
            } else {
                $ingredientsId = [];
            }

            $query = $this->mealRepository->returnMealsWithIngredients($query, $ingredientsId);
        }

        if ($category !== null) {
           $query = $this->mealRepository->returnMealWithCategory($query, $category);
        }
    
        $with = $request->input('with', []);
        if (!empty($with)) {
            $relationships = explode(',', $with);
            $query->with($relationships);
        }

        $query = $this->mealRepository->translateMeals($query, $languageId);
    
        return $query->paginate($elementsPerPage, ['*'], 'page', $page);
    }
}  