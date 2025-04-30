<?php

namespace App\Http\Controllers;

use App\Models\DeliveryStatus;
use App\Models\Food;
use App\Models\MenuDay;
use App\Models\OrderDetail;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    function index()
    {
        return view('admin');
    }
    public function getAllUsers()
    {
        $users = User::where('role_id', '!=', 1)->get();
        // dd($users);
        return view('admin ', compact('users'));
    }
    public function deleteuser($id)
    {
        // Mencari user berdasarkan ID
        $user = User::findOrFail($id);

        $user->orders()->delete();

        // Menghapus user
        $user->delete();

        // Mengalihkan kembali ke halaman daftar user dengan pesan sukses
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
    public function editUser($id)
    {
        // Mencari user berdasarkan ID
        $user = User::findOrFail($id);

        // Menampilkan halaman edit user dengan data user
        return view('editUser', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Mencari user berdasarkan ID
        $user = User::findOrFail($id);

        // Memperbarui data user
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // Mengalihkan kembali ke halaman daftar user dengan pesan sukses
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function getAllRestaurants()
    {
        $restaurants = Restaurant::all();
        return view('adminrestaurant', compact('restaurants'));
    }

    // Store the newly created restaurant in the database
    public function storeRestaurant(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'restaurantName' => 'required|string|max:255',
            'restaurantAddress' => 'required|string|max:255',
            'restaurantPhone' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the restaurant
        Restaurant::create([
            'restaurantName' => $request->restaurantName,
            'restaurantAddress' => $request->restaurantAddress,
            'restaurantPhone' => $request->restaurantPhone,
        ]);

        // Redirect back with success message
        return redirect()->route('admin.restaurants')->with('success', 'Restaurant created successfully.');
    }

    public function deleteRestaurant($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();

        return redirect()->route('admin.restaurants')->with('success', 'Restaurant and related data deleted successfully.');
    }
    public function editRestaurant($id)
    {
        // Cari restoran berdasarkan ID
        $restaurant = Restaurant::findOrFail($id);

        // Tampilkan form edit dengan data restoran
        return view('editRestaurant', compact('restaurant'));
    }

    public function updateRestaurant(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'restaurantName' => 'required|string|max:255',
            'restaurantAddress' => 'required|string|max:255',
            'restaurantPhone' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cari restoran berdasarkan ID
        $restaurant = Restaurant::findOrFail($id);

        // Update data restoran
        $restaurant->update([
            'restaurantName' => $request->restaurantName,
            'restaurantAddress' => $request->restaurantAddress,
            'restaurantPhone' => $request->restaurantPhone,
        ]);

        // Redirect kembali ke halaman daftar restoran dengan pesan sukses
        return redirect()->route('admin.restaurants')->with('success', 'Restaurant updated successfully.');
    }


    public function getAllFoods()
    {
        $foods = Food::with('foodToMenuDay')->get(); // Eager load the MenuDay relationship
        $restaurants = Restaurant::all();

        return view('adminfood', compact('foods', 'restaurants'));
    }



    // 2. Create New Food
    public function createFood()
    {
        // Fetch all restaurants
        $restaurants = Restaurant::all();
        return view('createFood', compact('restaurants'));
    }

    public function storeFood(Request $request)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            'foodName' => 'required|string|max:255',
            'foodDescription' => 'nullable|string|max:255',
            'foodPrice' => 'required|numeric',
            'foodImages.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'restaurant_id' => 'required|exists:restaurants,id',
            'foodDate' => 'nullable|date', // Validate food date
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('foodImages')) {
            foreach ($request->file('foodImages') as $key => $image) {
                $imageName = time() . "_{$key}." . $image->extension();
                $image->move(public_path('images/foods'), $imageName);
                $imagePaths[] = 'images/foods/' . $imageName;
            }
        }

        // Save images as a comma-separated string
        $imagePathsString = implode(',', $imagePaths);

        // Create the food item
        $food = Food::create([
            'foodName' => $request->foodName,
            'foodDescription' => $request->foodDescription,
            'foodPrice' => $request->foodPrice,
            'foodImage' => $imagePathsString,
            'restaurant_id' => $request->restaurant_id,
        ]);

        // If a food date is provided, create a MenuDay
        if ($request->foodDate) {
            MenuDay::create([
                'foodDate' => $request->foodDate,
                'food_id' => $food->id,
            ]);
        }

        return redirect()->route('admin.foods')->with('success', 'Food created successfully.');
    }


    public function editFood($id)
    {
        $food = Food::findOrFail($id);
        $restaurants = Restaurant::all(); 
        return view('editFood', compact('food', 'restaurants'));
    }

    public function updateFood(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'foodName' => 'required|string|max:255',
            'foodDescription' => 'nullable|string|max:255',
            'foodPrice' => 'required|numeric',
            'foodImage1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foodImage2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $food = Food::findOrFail($id);

        $imagePaths = explode(',', $food->foodImage);

        if ($request->hasFile('foodImage1')) {
            $imageName1 = time() . '_1.' . $request->file('foodImage1')->extension();
            $request->file('foodImage1')->move(public_path('images/foods'), $imageName1);
            $imagePaths[0] = 'images/foods/' . $imageName1; // Replace the first image
        }

        if ($request->hasFile('foodImage2')) {
            $imageName2 = time() . '_2.' . $request->file('foodImage2')->extension();
            $request->file('foodImage2')->move(public_path('images/foods'), $imageName2);
            $imagePaths[1] = 'images/foods/' . $imageName2; // Replace the second image
        }

        $food->update([
            'foodName' => $request->foodName,
            'foodDescription' => $request->foodDescription,
            'foodPrice' => $request->foodPrice,
            'foodImage' => implode(',', $imagePaths), // Save updated image paths
            'restaurant_id' => $request->restaurant_id,
        ]);

        return redirect()->route('admin.foods')->with('success', 'Food updated successfully.');
    }

    // 5. Delete Food
    public function deleteFood($id)
    {
        $food = Food::findOrFail($id);
        $food->delete();

        return redirect()->route('admin.foods')->with('success', 'Food deleted successfully.');
    }


    public function getAllOrderDetails()
    {
        // Fetch all order details with related data
        $orderDetails = OrderDetail::with([
            'menuDayInOrderDetail.foodInMenuDay.restaurantInFood', // MenuDay -> Food -> Restaurant
            'deliveryStatusInOrderDetail',                        // Delivery Status
            'orderInOrderDetail.user'                             // Order -> User
        ])->get();

        // Return the view with the fetched data
        return view('adminOrder', compact('orderDetails'));
    }

    public function editOrderDetail($id)
    {
        // Find the specific order detail or fail
        $orderDetail = OrderDetail::findOrFail($id);

        // Fetch related data for dropdowns
        $menuDays = MenuDay::all();
        $deliveryStatuses = DeliveryStatus::all();

        // Return the edit view with data
        return view('editOrder', compact('orderDetail', 'menuDays', 'deliveryStatuses'));
    }

    public function updateOrderDetail(Request $request, $id)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric',
            'unit' => 'required|integer',
            'delivery_status' => 'required|string|in:Waiting for delivery,On the delivery way,already received',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the specific order detail or fail
        $orderDetail = OrderDetail::findOrFail($id);

        // Update the order detail fields
        $orderDetail->update([
            'price' => $request->price,
            'unit' => $request->unit,
            'deliveryStatus_id' => DeliveryStatus::where('statusName', $request->delivery_status)->value('id'),
        ]);

        // Update the payment status in the related order
        $order = $orderDetail->orderInOrderDetail;
        $order->update([
            'paymentStatus' => $request->has('payment_status') ? 1 : 0,
        ]);

        // Redirect to the order details page with a success message
        return redirect()->route('admin.orderDetails')->with('success', 'Order detail updated successfully.');
    }

    public function deleteOrderDetail($id)
    {
        // Find the specific order detail or fail
        $orderDetail = OrderDetail::findOrFail($id);

        // Delete the order detail
        $orderDetail->delete();

        // Redirect to the order details page with a success message
        return redirect()->route('admin.orderDetails')->with('success', 'Order detail deleted successfully.');
    }
    
}
