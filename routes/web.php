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
Route::get('/cart', function () {
    return view('cart', [
        "pagetitle" => "NomNom"
    ]);
});




