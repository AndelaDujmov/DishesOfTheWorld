<?php

namespace App\Repositories;

interface MealRepositoryInterface{
    public function getLanguagesByLocale($locale);
    public function getAllMeals();
}