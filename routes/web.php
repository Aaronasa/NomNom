<?php

use App\Http\Controllers\AuthController;
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

Route::get('/signin', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', function () {
    return view('register'); // atau pakai controller jika kamu punya
})->name('register-form');

// Proses login dan register
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

//admin
// Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
//     Route::get('/', [AdminController::class, 'index'])->name('admin');
//     Route::get('/', [AdminController::class, 'getAllUsers'])->name('admin.users');
// });

// // User
// // Rute yang memerlukan login (middleware auth)
// Route::middleware(['auth', 'role:user'])->group(function () {
//     // Logout
//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
//     Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// });





