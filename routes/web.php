<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Index');
})->name('customer.index');

Route::get('/dashboard', function () {
    return inertia('Customer/Dashboard');
})->name('customer.dashboard');

Route::get('/product', function () {
    return inertia('Customer/Product');
})->name('customer.product');

Route::get('/cart', function () {
    return inertia('Customer/Cart');
})->name('customer.cart');

Route::get('/profile', function () {
    return inertia('Customer/Profile');
})->name('customer.profile');

Route::get('/orders', function () {
    return inertia('Customer/Orders');
})->name('customer.orders');

// Admin Routes
Route::get('/admin/dashboard', function () {
    return inertia('Admin/Dashboard');
})->name('admin.dashboard');

Route::get('/admin/sales', function () {
    return inertia('Admin/Sales');
})->name('admin.sales');

Route::get('/admin/inventory', function () {
    return inertia('Admin/Inventory');
})->name('admin.inventory');

Route::get('/admin/employee', function () {
    return inertia('Admin/Employee');
})->name('admin.employee');

Route::get('/admin/profile', function () {
    return inertia('Admin/Profile');
})->name('admin.profile');