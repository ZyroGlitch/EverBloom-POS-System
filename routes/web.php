<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\EmployeeMiddleware;
use Illuminate\Support\Facades\Route;

// Route::middleware('guest')->group(function () {
//     Route::get('/', function () {
//         return inertia('Index');
//     })->name('customer.index');

//     Route::post('/authentication', [UserController::class,'authentication'])
//     ->name('customer.authentication');
// });

    Route::get('/', function () {
        return inertia('Index');
    })->name('customer.index');

    Route::post('/authentication', [UserController::class,'authentication'])
    ->name('customer.authentication');


Route::middleware(['auth', EmployeeMiddleware::class])->group(function () {
    
    // Product-Feature Routes
    Route::get('/product', [ProductController::class,'displayProduct'])
    ->name('customer.product');

    Route::get('/product/showProduct/{product_id}', [ProductController::class,'showProduct'])
    ->name('customer.showProduct');

    Route::post('/product/showProduct/addToCart', [ProductController::class,'addToCart'])
    ->name('customer.addToCart');

    // ----------------------------------------------------------------------------

    // Cart-Feature Routes
    Route::get('/cart', [CartController::class,'cart'])
    ->name('customer.cart');

    Route::get('/cart/removeItem/{cart_id}', [CartController::class,'removeItem'])
    ->name('customer.removeItem');

    Route::post('/cart/checkout', [CartController::class,'checkout'])
    ->name('customer.checkout');

    Route::get('/cart/checkout/invoice/{order_id}', [CartController::class,'invoice'])
    ->name('customer.invoice');

    // ----------------------------------------------------------------------------

    // Profile Routes
    Route::get('/profile', [UserController::class,'customer_profile'])
    ->name('customer.profile');

    Route::post('/profile/updateProfileInfo',[UserController::class,'updateProfileInfo'])
    ->name('customer.updateProfileInfo');

    Route::post('/profile/updateProfilePassword',[UserController::class,'updateProfilePassword'])
    ->name('customer.updateProfilePassword');

     // ----------------------------------------------------------------------------

    Route::get('/orders', [OrderController::class,'orders'])->name('customer.orders');

    Route::post('/employee/logout', [UserController::class,'employeeLogout'])
    ->name('employee.logout');
});


require __DIR__ . '/admin.php';