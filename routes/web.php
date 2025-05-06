<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuDayController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VendorController;
use App\Models\MenuDay;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLoginForms'])->name('welcome');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', function () {
    return view('register');
})->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Vendor Routes
// Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->group(function () {
    // Dashboard
    Route::get('/dashboard', [VendorController::class, 'dashboard'])->name('VendorDashboard');
    
    // Restaurant Profile
    Route::get('/profile', [VendorController::class, 'profile'])->name('vendor.profile');
    Route::post('/profile', [VendorController::class, 'updateProfile'])->name('vendor.profile.update');
    
    // Products (Foods)
    Route::get('/products', [VendorController::class, 'productsIndex'])->name('vendor.products.index');
    Route::get('/products/create', [VendorController::class, 'createProduct'])->name('vendor.products.create');
    Route::post('/products', [VendorController::class, 'storeProduct'])->name('vendor.products.store');
    Route::get('/products/{id}/edit', [VendorController::class, 'editProduct'])->name('vendor.products.edit');
    Route::put('/products/{id}', [VendorController::class, 'updateProduct'])->name('vendor.products.update');
    Route::delete('/products/{id}', [VendorController::class, 'destroyProduct'])->name('vendor.products.destroy');
    
    // Orders
    Route::get('/orders', [VendorController::class, 'ordersIndex'])->name('vendor.orders.index');
    Route::get('/orders/{id}', [VendorController::class, 'showOrder'])->name('vendor.orders.show');
    Route::post('/orders/status/{id}', [VendorController::class, 'updateOrderStatus'])->name('vendor.orders.updateStatus');
// });

// admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::get('/', [AdminController::class, 'getAllUsers'])->name('admin.users');
    Route::delete('/{user}', [AdminController::class, 'deleteuser'])->name('admin.deleteuser');
    Route::get('/user/{id}/edit', [AdminController::class, 'editUser'])->name('admin.edituser');
    Route::put('/user/{id}', [AdminController::class, 'updateUser'])->name('admin.updateuser');
    Route::get('/restaurants', [AdminController::class, 'getAllRestaurants'])->name('admin.restaurants');
    Route::get('/restaurants/create', [AdminController::class, 'createRestaurant'])->name('admin.restaurants.create');
    Route::post('/restaurants', [AdminController::class, 'storeRestaurant'])->name('admin.restaurants.store');
    Route::delete('/restaurants/{id}', [AdminController::class, 'deleteRestaurant'])->name('admin.restaurants.delete');
    Route::get('/restaurants/{id}/edit', [AdminController::class, 'editRestaurant'])->name('admin.restaurants.edit');
    Route::put('/restaurants/{id}', [AdminController::class, 'updateRestaurant'])->name('admin.restaurants.update');
    // Food Management Routes
    Route::get('/foods', [AdminController::class, 'getAllFoods'])->name('admin.foods');
    Route::get('/foods/create', [AdminController::class, 'createFood'])->name('admin.foods.create');
    Route::post('/foods', [AdminController::class, 'storeFood'])->name('admin.foods.store');
    Route::get('/foods/{id}/edit', [AdminController::class, 'editFood'])->name('admin.foods.edit');
    Route::put('/foods/{id}', [AdminController::class, 'updateFood'])->name('admin.foods.update');
    Route::delete('/foods/{id}', [AdminController::class, 'deleteFood'])->name('admin.foods.delete');

    Route::get('/order-details', [AdminController::class, 'getAllOrderDetails'])->name('admin.orderDetails');
    Route::get('/order-details/{id}/edit', [AdminController::class, 'editOrderDetail'])->name('admin.orderDetails.edit');
    Route::put('/order-details/{id}', [AdminController::class, 'updateOrderDetail'])->name('admin.orderDetails.update');
    Route::delete('/order-details/{id}', [AdminController::class, 'deleteOrderDetail'])->name('admin.orderDetails.delete');
});

// User
// Rute yang memerlukan login (middleware auth)
Route::middleware(['auth', 'role:user'])->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Menu dan pesanan
    Route::get('/home', [MenuDayController::class, 'ViewMenuDay'])->name('home');
    Route::get('/order', [MenuDayController::class, 'ViewOrder'])->name('order.view');
    Route::post('/cart/add', [MenuDayController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [MenuDayController::class, 'showCart'])->name('cart.show');
    
    Route::post('/cart/finish', [MenuDayController::class, 'cartfinish'])->name('cart.finish');
    Route::delete('/cart/remove', [MenuDayController::class, 'removeCart'])->name('cart.remove');

    Route::get('food/{id}', [MenuDayController::class, 'foodDetail'])->name('food.detail');

    // Payment routes
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
    Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
    
    Route::get('/detail', [AuthController::class, 'showUpdateForm'])->name('ProfileDetail.update');
    Route::put('/profile/update', [AuthController::class, 'update'])->middleware('auth');
    Route::post('/account/delete', [AuthController::class, 'deleteAccount'])->name('account.delete')->middleware('auth');

    // Riwayat pesanan
    Route::get('/history', [OrderController::class, 'index'])->name('history');
    Route::get('/orders/{order}/details', [OrderController::class, 'getOrderDetails'])->name('order.details');
    Route::get('/order/{order}/detail', [OrderController::class, 'showOrderDetail'])->name('order.detail.page');

    // Riwayat pesanan (Alternatif route)
    Route::get('/orders/history', [OrderController::class, 'index'])->name('order.history');
    // Add these routes to your web.php
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    // Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
});