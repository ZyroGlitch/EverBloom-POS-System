<?php

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

    Route::get('/product', [ProductController::class,'displayProduct'])
    ->name('customer.product');

    Route::get('/cart', function () {
        return inertia('Customer/Cart');
    })->name('customer.cart');

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

    Route::get('/admin/inventory', [ProductController::class,'showInventoryProduct'])->name('admin.inventory');

    Route::get('/admin/employee', [UserController::class,'displayEmployee'])
    ->name('admin.employee');

    Route::get('/admin/profile', function () {
        return inertia('Admin/Profile');
    })->name('admin.profile');

    // Employee-Feature Routes
    Route::get('/admin/employee/addEmployee', function () {
        return inertia('Admin/Employee_Features/AddEmployee');
    })->name('employee.addEmployee');

    Route::post('/admin/employee/addEmployee/store',[UserController::class,'storeEmployeeData'])->name('employee.storeEmployeeData');

    // Inventory-Feature Routes
    Route::get('/admin/inventory/addProduct', function () {
        return inertia('Admin/Inventory_Features/AddProduct');
    })->name('inventory.addProduct');

    Route::post('/admin/inventory/addProduct/store',[ProductController::class,'storeProduct'])->name('inventory.storeProduct');

    Route::post('/admin/logout', [UserController::class,'adminLogout'])->withoutMiddleware('auth')
    ->name('admin.logout');
});