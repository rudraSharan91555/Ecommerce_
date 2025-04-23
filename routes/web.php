<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserAdmin\CartController;
use App\Http\Controllers\UserAdmin\CheckoutController;
use App\Http\Controllers\UserAdmin\ProductController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guestOrVerified'])->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('home');
    Route::get('/product/{product:slug}', [ProductController::class, 'view'])->name('product.view');

    Route::prefix('/cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{product:slug}', [CartController::class, 'add'])->name('add');
        Route::post('/remove/{product:slug}', [CartController::class, 'remove'])->name('remove');
        Route::post('/update-quantity/{product:slug}', [CartController::class, 'updateQuantity'])->name('update-quantity');
    });
});

Route::middleware(['auth','verified'])->group(function(){
    Route::get('/profile',[ProfileController::class,'view'])->name('profile');
    Route::post('/profile',[ProfileController::class, 'store'])->name('profile.update');
    Route::post('/profile/password-update', [ProfileController::class, 'passwordUpdate'])->name('profile_password.update');
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('cart.checkout');
    Route::post('/checkout/:order', [CheckoutController::class, 'checkoutOrder'])->name('cart.checkout-order');
    Route::post('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::post('/checkout/failure', [CheckoutController::class, 'failure'])->name('checkout.failure');
    Route::post('checkout/failure', [CheckoutController::class, 'fail'])->name('checkout.failure');
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/orders/{order}', [OrderController::class, 'view'])->name('order.view');
});




 

require __DIR__.'/auth.php';
