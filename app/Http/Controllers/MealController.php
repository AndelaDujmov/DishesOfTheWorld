<?php

namespace App\Http\Controllers;

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
        
            return response()->json([
                'status' => 200,
                'meals' => $meals->items(),
                'currentPage' => $meals->currentPage(),
                'lastPage' => $meals->lastPage()
            ]);
            
        }catch(Exception $e){
            return response()->json([
                'status' => 404,
                'message' => $e
            ]);
        }
    }
}

