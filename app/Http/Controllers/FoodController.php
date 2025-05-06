<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    public function ViewFood()
    {
        $foods = Food::with('restaurantInFood')->get();
        return view('home', [
            "foods" => $foods
        ]);
    }

    public function vendorFoods()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Cek apakah user punya restaurant
        if (!$user->restaurant) {
            return redirect()->route('restaurants.create')->with('error', 'Anda belum memiliki restaurant.');
        }

        // Ambil semua food yang dimiliki oleh restoran user ini
        $foods = $user->restaurant->restaurantToFood;

        return view('vendor.foods.index', compact('foods'));
    }
}
