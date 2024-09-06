<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AdminAuthController;

Route::middleware(['redirectAdmin'])->prefix('admin/')->as('admin.')->group(function() {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'admin'])->prefix('admin/')->as('admin.')->group(function() {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

     //products routes 
    Route::prefix('products/')->as('products.')->group(function() {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::post('store',[ProductController::class,'store'])->name('store');
        Route::put('update/{id}',[ProductController::class,'update'])->name('update');
        Route::delete('image/{id}',[ProductController::class,'deleteImage'])->name('image.delete');
        Route::delete('destory/{id}',[ProductController::class,'destory'])->name('destory');
    });
});