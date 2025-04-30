<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        "pagetitle" => "NomNom"
    ]);
});
Route::get('/menu', function () {
    return view('menu', [
        "pagetitle" => "NomNom"
    ]);
});

Route::get('/reviews', function () {
    return view('reviews', [
        "pagetitle" => "NomNom"
    ]);
});
Route::get('/myorder', function () {
    return view('myorder', [
        "pagetitle" => "NomNom"
    ]);
});

Route::post('/cart', function () {
    $cart = session()->get('cart', []);

    // Get item data from the request
    $itemId = request('id');
    $itemName = request('name');
    $itemPrice = request('price');
    $itemImage = request('image');
    $itemQuantity = request('quantity');

    // Check if the item is already in the cart
    $found = false;
    foreach ($cart as &$cartItem) {
        if ($cartItem['id'] == $itemId) {
            $cartItem['quantity'] += $itemQuantity; // Update the quantity
            $found = true;
            break;
        }
    }

    // If not found, add a new item to the cart
    if (!$found) {
        $cart[] = [
            'id' => $itemId,
            'name' => $itemName,
            'price' => $itemPrice,
            'image' => $itemImage,
            'quantity' => $itemQuantity,
        ];
    }

    // Save the updated cart to the session
    session(['cart' => $cart]);

    // Redirect back to the cart page
    return back();
});





