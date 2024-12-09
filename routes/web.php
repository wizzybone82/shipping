<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\ShippingOrderController;

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
    return redirect()->route('admin.auth.index'); // Redirect to admin login page
});

// Admin authentication routes
Route::resource('admin/auth', AdminAuthController::class)
    ->only(['index', 'create', 'store', 'destroy'])
    ->names([
        'index' => 'admin.auth.index',
        'create' => 'admin.auth.create',
        'store' => 'admin.auth.store',
        'destroy' => 'admin.auth.destroy',
    ]);

// Admin shipping order routes
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Resource route for shipping orders
    Route::resource('shipping-orders', ShippingOrderController::class)->except([
        'destroy' // We'll use a custom cancel route instead
    ]);
    
    // Custom route to cancel an order
    Route::patch('shipping-orders/{id}/cancel', [ShippingOrderController::class, 'cancel'])->name('shipping-orders.cancel');
});

