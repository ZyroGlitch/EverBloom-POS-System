<?php

use App\Http\Controllers\CartController;
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
    Route::get('/dashboard', function () {
        return inertia('Customer/Dashboard');
    })->name('customer.dashboard');

    // ----------------------------------------------------------------------------
    
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

    Route::post('/cart/checkout', [CartController::class,'checkout'])
    ->name('customer.checkout');

    Route::get('/cart/checkout/invoice/{order_id}', [CartController::class,'invoice'])
    ->name('customer.invoice');

    // ----------------------------------------------------------------------------

    Route::get('/profile', function () {
        return inertia('Customer/Profile');
    })->name('customer.profile');

    Route::get('/orders', function () {
        return inertia('Customer/Orders');
    })->name('customer.orders');

    Route::post('/employee/logout', [UserController::class,'employeeLogout'])
    ->name('employee.logout');
});

Route::middleware(['auth',AdminMiddleware::class])->group(function () {
    // Admin Routes
    Route::get('/admin/dashboard', function () {
        return inertia('Admin/Dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/sales', function () {
        return inertia('Admin/Sales');
    })->name('admin.sales');

    Route::get('/admin/inventory', [ProductController::class,'showInventoryProduct'])
    ->name('admin.inventory');

    Route::get('/admin/employee', [UserController::class,'displayEmployee'])
    ->name('admin.employee');

    // ----------------------------------------------------------------------------
    // Admin-Features Routes
    Route::get('/admin/profile', [UserController::class,'adminProfile'])
    ->name('admin.profile');

    Route::post('/admin/profile/updateAdminInfo',[UserController::class,'updateAdminInfo'])
    ->name('admin.updateAdminInfo');

    Route::post('/admin/profile/updateAdminPassword',[UserController::class,'updateAdminPassword'])
    ->name('admin.updateAdminPassword');

    // ----------------------------------------------------------------------------
    // Employee-Feature Routes
    Route::get('/admin/employee/addEmployee', function () {
        return inertia('Admin/Employee_Features/AddEmployee');
    })->name('employee.addEmployee');

    Route::post('/admin/employee/addEmployee/store',[UserController::class,'storeEmployeeData'])->name('employee.storeEmployeeData');

    Route::get('/admin/employee/viewProfile/{user_id}', [UserController::class,'viewEmployeeProfile'])
    ->name('employee.viewProfile');

    Route::post('/admin/employee/viewProfile/updateUserInfo',[UserController::class,'updateUserInfo'])->name('employee.updateUserInfo');

    Route::post('/admin/employee/viewProfile/updatePassword',[UserController::class,'updatePassword'])->name('employee.updatePassword');

    // ----------------------------------------------------------------------------

    // Inventory-Feature Routes
    Route::get('/admin/inventory/addProduct', function () {
        return inertia('Admin/Inventory_Features/AddProduct');
    })->name('inventory.addProduct');

    Route::post('/admin/inventory/addProduct/store',[ProductController::class,'storeProduct'])->name('inventory.storeProduct');

    Route::get('/admin/inventory/viewProduct/{product_id}', [ProductController::class,'viewProduct'])
    ->name('inventory.viewProduct');

    Route::post('/admin/inventory/viewProduct/updateProduct',[ProductController::class,'updateProduct'])
    ->name('inventory.updateProduct');
    // ----------------------------------------------------------------------------

    Route::post('/admin/logout', [UserController::class,'adminLogout'])->withoutMiddleware('auth')
    ->name('admin.logout');
});