<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\DashboardController;

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/dashboard',[DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

//routes for products list and filter 
Route::prefix('products')->group(function ()  {
    Route::get('/',[ProductController::class, 'index'])->name('products.index');
    
});

//add to cart 

Route::prefix('cart')->controller(CartController::class)->group(function () {
    Route::get('view','view')->name('cart.view');
    Route::post('store/{product}','store')->name('cart.store');
    Route::patch('update/{product}','update')->name('cart.update');
    Route::delete('delete/{product}','delete')->name('cart.delete');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

require __DIR__.'/admin.php';
