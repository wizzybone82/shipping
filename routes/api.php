<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\ShippingOrderController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/




// User registration and login routes
Route::post('user/register', [UserAuthController::class, 'register'])->name('user.register');
Route::post('user/login', [UserAuthController::class, 'login'])->name('user.login');

// Protected routes for authenticated users
Route::middleware('auth:sanctum')->group(function () {
     Route::post('user/logout', [UserAuthController::class, 'logout'])->name('user.logout');
     Route::get('user', [UserAuthController::class, 'getUser'])->name('user.get'); // Fetch authenticated user
         // Get the count of orders based on status
         Route::get('/shipping-orders/count-by-status', [ShippingOrderController::class, 'countByStatus']);

     // Create a shipping order
     Route::post('/shipping-orders', [ShippingOrderController::class, 'create']);

     // Cancel a shipping order
     Route::put('/shipping-orders/{id}/cancel', [ShippingOrderController::class, 'cancel']);

     //Get shipping order details
     Route::get('/shipping-orders/{id}', [ShippingOrderController::class, 'show']);

 
     // Get the list of user's shipping orders
     Route::get('/shipping-orders', [ShippingOrderController::class, 'index']);
 
 

});

