<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\ShippingOrderController;
use App\Http\Controllers\Admin\ManageUsersController;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Redirect to admin dashboard
Route::get('/', function () {
    return redirect()->route('admin.index'); // Redirect to admin login page
});

// Admin authentication routes
Route::resource('admin', AdminAuthController::class)
    ->only(['index', 'create', 'store', 'destroy'])
    ->names([
        'index' => 'admin.index',
        'create' => 'admin.create',
        'store' => 'admin.store',
        'destroy' => 'admin.destroy',
    ]);

// Admin shipping order routes
Route::middleware(['auth:admin'])->group(function () {
    // Resource route for shipping orders
    Route::resource('shipping-orders', ShippingOrderController::class);
    // Resource for users to manage them
    Route::resource('users', ManageUsersController::class);

    
});

