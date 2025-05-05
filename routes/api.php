<?php


use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('products', ProductController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('customers', CustomerController::class);
    Route::get('countries', [CustomerController::class, 'countries']);
    Route::get('orders', [OrderController::class, 'index']);
    Route::get('orders/statuses', [OrderController::class, 'getStatuses']);
    Route::post('orders/change-status/{order}/{status}', [OrderController::class, 'changeStatus']);
    Route::get('orders/{order}', [OrderController::class, 'view']);

    // Dashboard
    Route::get('dashboard/customers-count', [DashboardController::class, 'activeCustomers']);
    Route::get('dashboard/products-count', [DashboardController::class, 'activeProducts']);
    Route::get('dashboard/oders-count', [DashboardController::class, 'paidOrders']);
    Route::get('dashboard/income-amount', [DashboardController::class, 'totalIncome']);

});

Route::post('/login', [AuthController::class, 'login']);
