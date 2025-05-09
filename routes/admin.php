<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProductController;

Route::middleware(['auth',AdminMiddleware::class])->group(function () {
    // Admin Routes
    Route::get('/admin/dashboard', [UserController::class,'dashboard'])
    ->name('admin.dashboard');

    // ----------------------------------------------------------------------------

    // Sales-Features Routes
    Route::get('/admin/sales/{order_id?}', [UserController::class,'sales'])
    ->name('admin.sales');

    Route::get('/admin/sales/invoice/{order_id}', [CartController::class,'downloadInvoice'])
    ->name('admin.invoice');

    Route::post('/admin/sales/searchedOrderID', [UserController::class,'searchedOrderID'])
    ->name('admin.searchedOrderID');

    Route::get('/admin/sales/selectedEmployee/{user_id}', [UserController::class,'selectedEmployee'])
    ->name('admin.selectedEmployee');

    // ----------------------------------------------------------------------------

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