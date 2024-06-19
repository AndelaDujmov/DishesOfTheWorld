<?php

namespace App\Repositories;

interface MealRepositoryInterface{
    public function getLanguagesByLocale($locale);

    public function queryMeal();

    public function returnMealsWithTag($query, $tagIds);

    public function returnMealsWithIngredients($query, $ingredientsId);

    public function returnMealWithCategory($query, $categoryId);

    public function getAllMealsModifiedAt($query, $diffTime);

    public function translateMeals($query, $language);
}