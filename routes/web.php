<?php

use App\Http\Controllers\Admin\AuthController as AdminAuth;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Customer\AuthController as CustomerAuth;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboard;

// ADMIN 
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login',[AdminAuth::class,'loginForm'])->name('login');
    Route::post('login',[AdminAuth::class,'login'])->name('login.post');

    Route::middleware('admin.auth')->group(function () {
        Route::get('dashboard',[AdminDashboard::class,'index'])->name('dashboard');
        Route::post('logout',[AdminAuth::class,'logout'])->name('logout');
    });
});

// CUSTOMER 
Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('login',[CustomerAuth::class,'loginForm'])->name('login');
    Route::post('login',[CustomerAuth::class,'login']);

    Route::middleware('customer.auth')->group(function () {
        Route::get('dashboard',[CustomerDashboard::class,'index'])->name('dashboard');
        Route::post('logout',[CustomerAuth::class,'logout'])->name('logout');
    });
});
