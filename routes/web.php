<?php

use App\Http\Controllers\Admin\AuthController as AdminAuth;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Customer\AuthController as CustomerAuth;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboard;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

// ADMIN 
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login',[AdminAuth::class,'loginForm'])->name('login');
    Route::post('login',[AdminAuth::class,'login'])->name('login.post');

    Route::middleware('admin.auth')->group(function () {
        Route::get('dashboard',[AdminDashboard::class,'index'])->name('dashboard');
        Route::post('logout',[AdminAuth::class,'logout'])->name('logout');
        Route::resource('categories', CategoryController::class);
        Route::get('/products/import', [ProductController::class, 'importForm'])->name('products.import.form');
        Route::post('/products/import', [ProductController::class, 'import'])->name('products.import.store');
        Route::resource('products', ProductController::class);


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
Route::get('/check-upload-limit', function () {
    return [
        'upload_max_filesize' => ini_get('upload_max_filesize'),
        'post_max_size' => ini_get('post_max_size'),
        'memory_limit' => ini_get('memory_limit'),
    ];
});
// In app/routes/web.php
Route::get('/debug-auth', function () {
    return response()->json([
        'session_id' => session()->getId(),
        'csrf_token' => csrf_token(),
        'auth' => [
            'check' => auth()->check(),
            'user' => auth()->user() ? [
                'id' => auth()->user()->id,
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ] : null,
            'guard_web' => auth()->guard('web')->check(),
            'guard_admin' => auth()->guard('admin')->check(),
            'guard_customer' => auth()->guard('customer')->check(),
        ],
        'session' => session()->all(),
        'cookies' => request()->cookies->all(),
        'headers' => [
            'user-agent' => request()->header('User-Agent'),
            'x-csrf-token' => request()->header('X-CSRF-Token'),
        ],
    ]);
});

// Test broadcasting endpoint directly
Route::post('/test-broadcast-auth', function () {
    // Simulate what Echo does
    $request = request();
    
    Log::channel('broadcasting')->info('Manual test request', [
        'input' => $request->all(),
        'headers' => $request->headers->all(),
        'session_id' => session()->getId(),
        'auth' => auth()->check(),
    ]);
    
    // Manually call the channel authorization
    $channel = 'presence.online';
    $channelName = $request->input('channel_name');
    
    return response()->json([
        'channel_name' => $channelName,
        'auth' => Broadcast::auth($request),
    ]);
});
