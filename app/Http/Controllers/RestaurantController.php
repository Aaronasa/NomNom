<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the restaurants.
     */
    public function index()
    {
        $restaurants = Restaurant::with('owner')->get();
        return view('restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new restaurant.
     */
    public function create()
    {
        // Ambil semua user dengan role_id = 3 yang belum memiliki restaurant
        $availableOwners = User::where('role_id', 3)
            ->whereDoesntHave('restaurant')
            ->get();
            
        return view('restaurants.create', compact('availableOwners'));
    }

    /**
     * Store a newly created restaurant in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'restaurantName' => 'required|string|max:255',
            'restaurantAddress' => 'required|string',
            'restaurantPhone' => 'required|string|max:15',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Verifikasi bahwa user memiliki role_id = 3
        $user = User::find($request->user_id);
        if (!$user || $user->role_id !== 3) {
            return redirect()->back()
                ->withErrors(['user_id' => 'User harus memiliki role restaurant owner (role_id = 3)'])
                ->withInput();
        }

        // Verifikasi bahwa user belum memiliki restaurant
        if ($user->restaurant) {
            return redirect()->back()
                ->withErrors(['user_id' => 'User ini sudah memiliki restaurant'])
                ->withInput();
        }

        try {
            Restaurant::create($request->all());
            return redirect()->route('restaurants.index')
                ->with('success', 'Restaurant berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['message' => $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Display the specified restaurant.
     */
    public function show(Restaurant $restaurant)
    {
        $restaurant->load('owner');
        return view('restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified restaurant.
     */
    public function edit(Restaurant $restaurant)
    {
        // Ambil semua user dengan role_id = 3 yang belum memiliki restaurant atau pemilik restaurant saat ini
        $availableOwners = User::where('role_id', 3)
            ->where(function ($query) use ($restaurant) {
                $query->whereDoesntHave('restaurant')
                    ->orWhere('id', $restaurant->user_id);
            })
            ->get();
            
        return view('restaurants.edit', compact('restaurant', 'availableOwners'));
    }

    /**
     * Update the specified restaurant in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $validator = Validator::make($request->all(), [
            'restaurantName' => 'required|string|max:255',
            'restaurantAddress' => 'required|string',
            'restaurantPhone' => 'required|string|max:15',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Verifikasi bahwa user memiliki role_id = 3
        $user = User::find($request->user_id);
        if (!$user || $user->role_id !== 3) {
            return redirect()->back()
                ->withErrors(['user_id' => 'User harus memiliki role restaurant owner (role_id = 3)'])
                ->withInput();
        }

        // Verifikasi bahwa user belum memiliki restaurant atau pemilik saat ini
        if ($user->restaurant && $user->restaurant->id !== $restaurant->id) {
            return redirect()->back()
                ->withErrors(['user_id' => 'User ini sudah memiliki restaurant lain'])
                ->withInput();
        }

        try {
            $restaurant->update($request->all());
            return redirect()->route('restaurants.index')
                ->with('success', 'Restaurant berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['message' => $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Remove the specified restaurant from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        try {
            $restaurant->delete();
            return redirect()->route('restaurants.index')
                ->with('success', 'Restaurant berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['message' => $e->getMessage()]);
        }
    }
}
