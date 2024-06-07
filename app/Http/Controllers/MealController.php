<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function index(){
        $meal = Meal::all();
        if ($meal->count() > 0){
            return response()->json([
                'status' => 200,
                'meal' => $meal
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'meal' => "No Data Found"
            ],404);
        }
    }
}
