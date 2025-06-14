<?php
namespace App\Http\Controllers;

use App\Models\DeliveryStatus;
use App\Models\Food;
use App\Models\MenuDay;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    /**
     * Display the vendor dashboard with summary data
     */
    public function dashboard()
    {
        $restaurant = Auth::user()->restaurant; // Properly fetch related restaurant

        // Default values in case vendor has no restaurant yet
        $totalProducts = 0;
        $totalOrders   = 0;
        $totalRevenue  = 0;
        $products      = collect();
        $recentOrders  = collect();

        if ($restaurant) {
            // Get vendor's products using the relationship
            $products      = $restaurant->restaurantToFood()->latest()->get();
            $totalProducts = $restaurant->restaurantToFood()->count();

            // Get vendor's orders
            $foodIds    = $restaurant->restaurantToFood()->pluck('id');
            $menuDayIds = MenuDay::whereIn('food_id', $foodIds)->pluck('id');

            $orderDetails = OrderDetail::whereIn('menuDay_id', $menuDayIds)
                ->with(['orderInOrderDetail', 'orderInOrderDetail.user', 'menuDayInOrderDetail.foodInMenuDay'])
                ->get();

            $orderIds    = $orderDetails->pluck('order_id')->unique();
            $totalOrders = $orderIds->count();

            $totalRevenue = $orderDetails->sum(function ($orderDetail) {
                return $orderDetail->price * $orderDetail->unit;
            });

            $recentOrders = Order::whereIn('id', $orderIds)
                ->with('user')
                ->latest()
                ->take(5)
                ->get()
                ->map(function ($order) {
                    $order->status = $this->determineOrderStatus($order);
                    $order->total  = $order->totalPrice;
                    return $order;
                });
        }

        return view('VendorDashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalRevenue',
            'products',
            'recentOrders'
        ));
    }

    /**
     * Determine the status of an order based on its delivery status
     */
    private function determineOrderStatus($order)
    {
        $orderDetails = $order->orderDetailInOrder;

        if (! $order->paymentStatus) {
            return 'pending';
        }

        $hasProcessing = false;
        $allCompleted  = true;

        foreach ($orderDetails as $detail) {
            $statusId = $detail->deliveryStatus_id;

            if ($statusId == 1) { // Waiting for delivery
                $hasProcessing = true;
                $allCompleted  = false;
            } else if ($statusId == 2) { // On the delivery way
                $hasProcessing = true;
                $allCompleted  = false;
            } else if ($statusId != 3) { // Not received yet
                $allCompleted = false;
            }
        }

        if ($allCompleted) {
            return 'completed';
        } else if ($hasProcessing) {
            return 'processing';
        } else {
            return 'pending';
        }
    }

    /**
     * Display all products from the vendor's restaurant
     */
    public function productsIndex()
    {
        $restaurant = Auth::user()->restaurant;

        if (! $restaurant) {
            return redirect()->route('vendor.profile')->with('error', 'Please complete your restaurant profile first.');
        }

        $products = $restaurant->restaurantToFood()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $foodIds    = $restaurant->restaurantToFood()->pluck('id');
        $menuDayIds = MenuDay::whereIn('food_id', $foodIds)->pluck('id');

        $orderDetails = OrderDetail::whereIn('menuDay_id', $menuDayIds)
            ->with([
                'orderInOrderDetail',
                'orderInOrderDetail.user',
                'menuDayInOrderDetail.foodInMenuDay',
                'deliveryStatusInOrderDetail',
            ])
            ->get();
        return view('vendorManageProducts', compact('products', 'orderDetails'));
    }

    /**
     * Show the form for creating a new product
     */
    public function createProduct()
    {
     
        return view('vendorAddProduct');
    }

    /**
     * Store a newly created product in database
     */
    public function storeProduct(Request $request)
    {
        $restaurant = Restaurant::where('id', Auth::user()->restaurant_id)->first();

        if (! $restaurant) {
            return redirect()->route('vendor.profile')->with('error', 'Please complete your restaurant profile first.');
        }

        // Validate input data
        $validator = Validator::make($request->all(), [
            'foodName'        => 'required|string|max:255',
            'foodDescription' => 'nullable|string|max:255',
            'foodPrice'       => 'required|numeric',
            'foodImages.*'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foodDate'        => 'nullable|date', // Validate food date
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
            'foodName'        => $request->foodName,
            'foodDescription' => $request->foodDescription,
            'foodPrice'       => $request->foodPrice,
            'foodImage'       => $imagePathsString,
            'restaurant_id'   => $restaurant->id,
        ]);

        // If a food date is provided, create a MenuDay
        if ($request->foodDate) {
            MenuDay::create([
                'foodDate' => $request->foodDate,
                'food_id'  => $food->id,
            ]);
        }

        return redirect()->route('vendor.products.index')->with('success', 'Food created successfully.');
    }

    /**
     * Show the form for editing the specified product
     */
    public function editProduct($id)
    {
        $restaurant = Restaurant::where('id', Auth::user()->restaurant_id)->first();
        $food       = Food::where('id', $id)
            ->where('restaurant_id', $restaurant->id)
            ->firstOrFail();

        $menuDay = MenuDay::where('food_id', $food->id)->first();

        return view('vendor.products.edit', compact('food', 'restaurant', 'menuDay'));
    }

    /**
     * Update the specified product in database
     */
    public function updateProduct(Request $request, $id)
    {
        $restaurant = Restaurant::where('id', Auth::user()->restaurant_id)->first();
        $food       = Food::where('id', $id)
            ->where('restaurant_id', $restaurant->id)
            ->firstOrFail();

        // Validate input data
        $validator = Validator::make($request->all(), [
            'foodName'        => 'required|string|max:255',
            'foodDescription' => 'nullable|string|max:255',
            'foodPrice'       => 'required|numeric',
            'foodImage1'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foodImage2'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foodDate'        => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
            'foodName'        => $request->foodName,
            'foodDescription' => $request->foodDescription,
            'foodPrice'       => $request->foodPrice,
            'foodImage'       => implode(',', $imagePaths), // Save updated image paths
        ]);

        // Update or create MenuDay if date is provided
        if ($request->foodDate) {
            MenuDay::updateOrCreate(
                ['food_id' => $food->id],
                ['foodDate' => $request->foodDate]
            );
        }

        return redirect()->route('vendor.products.index')->with('success', 'Food updated successfully.');
    }

    /**
     * Remove the specified product from database
     */
    public function destroyProduct($id)
    {
        $restaurant = Restaurant::where('id', Auth::user()->restaurant_id)->first();
        $food       = Food::where('id', $id)
            ->where('restaurant_id', $restaurant->id)
            ->firstOrFail();

        // Delete related menu days first
        MenuDay::where('food_id', $food->id)->delete();

        // Delete the food
        $food->delete();

        return redirect()->route('vendor.products.index')->with('success', 'Food deleted successfully.');
    }

    /**
     * Display all orders for the vendor's products
     */
    public function ordersIndex()
    {
        $restaurant = Restaurant::where('id', Auth::user()->restaurant_id)->first();

        if (! $restaurant) {
            return redirect()->route('vendor.profile')->with('error', 'Please complete your restaurant profile first.');
        }

        // Get vendor's products and associated orders
        $foodIds    = Food::where('restaurant_id', $restaurant->id)->pluck('id');
        $menuDayIds = MenuDay::whereIn('food_id', $foodIds)->pluck('id');

        $orderDetails = OrderDetail::whereIn('menuDay_id', $menuDayIds)
            ->with([
                'orderInOrderDetail',
                'orderInOrderDetail.user',
                'menuDayInOrderDetail.foodInMenuDay',
                'deliveryStatusInOrderDetail',
            ])
            ->get();

        $orderIds = $orderDetails->pluck('order_id')->unique();

        $orders = Order::whereIn('id', $orderIds)
            ->with(['user', 'orderDetailInOrder'])
            ->latest()
            ->paginate(10);

        foreach ($orders as $order) {
            $order->status = $this->determineOrderStatus($order);
        }

        return view('vendor.orders.index', compact('orders', 'orderDetails'));
    }

    /**
     * Display details of a specific order
     */
    public function showOrder($id)
    {
        $restaurant = Restaurant::where('id', Auth::user()->restaurant_id)->first();

        if (! $restaurant) {
            return redirect()->route('vendor.profile')->with('error', 'Please complete your restaurant profile first.');
        }

        // Get vendor's products and associated orders
        $foodIds    = Food::where('restaurant_id', $restaurant->id)->pluck('id');
        $menuDayIds = MenuDay::whereIn('food_id', $foodIds)->pluck('id');

        $order = Order::where('id', $id)
            ->with(['user', 'orderDetailInOrder'])
            ->firstOrFail();

        $orderDetails = OrderDetail::where('order_id', $order->id)
            ->whereIn('menuDay_id', $menuDayIds)
            ->with([
                'menuDayInOrderDetail.foodInMenuDay',
                'deliveryStatusInOrderDetail',
            ])
            ->get();

        if ($orderDetails->isEmpty()) {
            return redirect()->route('vendor.orders.index')->with('error', 'This order does not contain any products from your restaurant.');
        }

        $deliveryStatuses = DeliveryStatus::all();

        return view('vendor.orders.show', compact('order', 'orderDetails', 'deliveryStatuses'));
    }

    /**
     * Update the delivery status of an order detail
     */
    public function updateOrderStatus(Request $request, $id)
    {
        $orderDetail = OrderDetail::findOrFail($id);

        // Verify this order detail is for the vendor's product
        $restaurant = Restaurant::where('id', Auth::user()->restaurant_id)->first();
        $foodIds    = Food::where('restaurant_id', $restaurant->id)->pluck('id');
        $menuDayIds = MenuDay::whereIn('food_id', $foodIds)->pluck('id');

        if (! $menuDayIds->contains($orderDetail->menuDay_id)) {
            return redirect()->route('vendor.orders.index')->with('error', 'You are not authorized to update this order.');
        }

        // Update the delivery status
        $orderDetail->update([
            'deliveryStatus_id' => $request->delivery_status_id,
        ]);

        return redirect()->route('vendor.orders.show', $orderDetail->order_id)
            ->with('success', 'Order status updated successfully.');
    }

    /**
     * Show the vendor profile form
     */
    public function profile()
    {
        $user       = Auth::user();
        $restaurant = $user->restaurant;

        // To this:
        return view('vendorProfile', compact('user', 'restaurant'));
    }

    /**
     * Update the vendor's profile and restaurant information
     */

public function updateProfile(Request $request)
{
    $user = Auth::user();

    $validated = $request->validate([
        'username' => 'required|string|max:255|unique:users,username,'.$user->id,
        'email' => 'required|email|unique:users,email,'.$user->id,
        'phone' => 'nullable|string|max:15',
        'address' => 'nullable|string|max:255'
    ]);

    $user->update($validated);

    return redirect()->route('vendor.profile')->with('success', 'Profile updated successfully');
}

    /**
     * Show form for creating a new restaurant
     */

public function createRestaurant()
{
    $user = Auth::user();
    
    if ($user->restaurant) {
        return redirect()->route('vendor.profile')->with('error', 'You already have a restaurant.');
    }
    
    return view('AddRestaurant');
}
    
    /**
     * Store a newly created restaurant in the database
     */
public function storeRestaurant(Request $request)
{
    $user = Auth::user();
    
    if ($user->restaurant) {
        return redirect()->route('vendor.profile')->with('error', 'You already have a restaurant.');
    }
    
    $validator = Validator::make($request->all(), [
        'restaurantName'    => 'required|string|max:255',
        'restaurantAddress' => 'required|string|max:255',
        'restaurantPhone'   => 'required|string|max:15',
    ]);
    
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    
    $restaurant = Restaurant::create([
        'restaurantName'    => $request->restaurantName,
        'restaurantAddress' => $request->restaurantAddress,
        'restaurantPhone'   => $request->restaurantPhone,
        'user_id'           => $user->id, // Set the user_id here
    ]);
    
    return redirect()->route('VendorDashboard')->with('success', 'Restaurant created successfully.');
}
    
    /**
     * Show form for editing the restaurant
     */
    public function editRestaurant()
    {
        $user = Auth::user();
        $restaurant = $user->restaurant;
        
        if (!$restaurant) {
            return redirect()->route('vendor.restaurant.create')->with('error', 'You need to create a restaurant first.');
        }
        
        return view('EditRestaurant', compact('restaurant'));
    }
    


public function updateRestaurant(Request $request)
{
    $user = Auth::user();
    $restaurant = $user->restaurant;

    if (!$restaurant) {
        return redirect()->route('vendor.restaurant.create');
    }

    // Validate restaurant fields
    $validator = Validator::make($request->all(), [
        'restaurantName'    => 'required|string|max:255',
        'restaurantAddress' => 'required|string|max:255',
        'restaurantPhone'   => 'required|string|max:15',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Update restaurant
    $restaurant->update([
        'restaurantName'    => $request->restaurantName,
        'restaurantAddress' => $request->restaurantAddress,
        'restaurantPhone'   => $request->restaurantPhone,
    ]);

    return redirect()->route('vendor.profile')->with('success', 'Restaurant updated successfully.');
}


    // Add these two methods inside VendorController

public function editOrderDetail($id)
{
    $restaurant = Auth::user()->restaurant;

    
    $orderDetail = OrderDetail::with([
        'menuDayInOrderDetail.foodInMenuDay',
        'orderInOrderDetail.user',
        'deliveryStatusInOrderDetail'
    ])->findOrFail($id);

    $foodIds = Food::where('restaurant_id', $restaurant->id)->pluck('id');
    $menuDayIds = MenuDay::whereIn('food_id', $foodIds)->pluck('id');

    if (!$menuDayIds->contains($orderDetail->menuDay_id)) {
        return redirect()->route('vendor.orders.index')->with('error', 'Unauthorized access to this order detail.');
    }

    $deliveryStatuses = DeliveryStatus::all();

    return view('edit', compact('orderDetail', 'deliveryStatuses'));
}


public function updateOrderDetail(Request $request, $id)
{
    $orderDetail = OrderDetail::findOrFail($id);

    $restaurant = Auth::user()->restaurant;
    $foodIds = Food::where('restaurant_id', $restaurant->id)->pluck('id');
    $menuDayIds = MenuDay::whereIn('food_id', $foodIds)->pluck('id');

    // if (!$menuDayIds->contains($orderDetail->menuDay_id)) {
    //     return redirect()->route('vendor.orders.index')->with('error', 'Unauthorized to update this order.');
    // }

    $request->validate([
        'price' => 'required|numeric',
        'unit' => 'required|integer',
        'delivery_status' => 'required|exists:delivery_statuses,statusName',
        'proof_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $orderDetail->update([
        'price' => $request->price,
        'unit' => $request->unit,
        'deliveryStatus_id' => DeliveryStatus::where('statusName', $request->delivery_status)->value('id'),
    ]);

    // Upload proof image if provided
    if ($request->hasFile('proof_image')) {
        $request->file('proof_image')->move(public_path('image/proofs'), $orderDetail->id . '.jpg');
    }

    return redirect()->route('vendor.products.index')->with('success', 'Order detail updated successfully.');
}

    
}