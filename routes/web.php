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

//admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::get('/', [AdminController::class, 'getAllUsers'])->name('admin.users');
});

// User
// Rute yang memerlukan login (middleware auth)
Route::middleware(['auth', 'role:user'])->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

});





