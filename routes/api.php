<?php


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
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
    Route::apiResource('categories', CategoryController::class)->except('show');
    Route::get('/categories/tree', [CategoryController::class, 'getAsTree']);
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
    Route::get('/dashboard/orders-by-country', [DashboardController::class, 'ordersByCountry']);
    Route::get('/dashboard/latest-customers', [DashboardController::class, 'latestCustomers']);
    Route::get('/dashboard/latest-orders', [DashboardController::class, 'latestOrders']);

    // Report routes
    Route::get('/report/orders', [ReportController::class, 'orders']);
    Route::get('/report/customers', [ReportController::class, 'customers']);

});

Route::post('/login', [AuthController::class, 'login']);
