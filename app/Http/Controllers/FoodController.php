<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function ViewFood()
    {
        $foods = Food::with('restaurantInFood')->get();
        return view ('home',[
                "foods" => $foods
        ]);
    }
}
