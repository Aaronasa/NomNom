<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function ViewRestaurant()
    {
        $restaurants = Restaurant::all();
        return view ('home',[
                "restaurants" => $restaurants
        ]);
    }
    
}
