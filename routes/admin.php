<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminAuthController;

Route::middleware(['redirectAdmin'])->prefix('admin/')->as('admin.')->group(function() {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'admin'])->prefix('admin/')->as('admin.')->group(function() {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

     //products routes 
     Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
     Route::post('/products/store',[ProductController::class,'store'])->name('admin.products.store');
     Route::put('/products/update/{id}',[ProductController::class,'update'])->name('admin.products.update');
     Route::delete('/products/image/{id}',[ProductController::class,'deleteImage'])->name('admin.products.image.delete');
     Route::delete('/products/destory/{id}',[ProductController::class,'destory'])->name('admin.products.destory');
});