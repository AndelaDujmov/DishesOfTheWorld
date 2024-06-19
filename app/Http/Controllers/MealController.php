<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExceptionResourse;
use App\Http\Resources\MealCollection;
use App\Services\MealServiceInterface;
use Exception;
use Illuminate\Http\Request;

class MealController extends Controller
{
    private MealServiceInterface $mealService;

    public function __construct(MealServiceInterface $mealServ) {
        $this->mealService = $mealServ;
    }

    public function index(Request $request)
    {
    
        try{
            $request->validate([
                'lang' => 'required'
            ]);

            $meals = $this->mealService->filterMeals($request);
        
            return new MealCollection($meals);
        }catch(Exception $e){
            return new ExceptionResourse('The lang field is required.');
        }
    }
}

