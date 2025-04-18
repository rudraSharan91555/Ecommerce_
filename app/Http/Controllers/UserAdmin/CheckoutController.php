<?php

namespace App\Http\Controllers\UserAdmin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Cart;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
{
    $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

    list($products, $cartItems) = Cart::getProductsAndCartItems();

    $totalAmount = 0;
    $lineItems = [];  
    foreach ($products as $product) {
        $quantity = $cartItems[$product->id]['quantity'] ?? 1;
        $totalAmount += $product->price * $quantity * 100; 
        $lineItems[] = [
            'name' => $product->title, 
            'quantity' => $quantity,
            'image' => $product->image,
            'currency' => 'INR',
            'unit_amount' => $product->price * 100,  
        ];
    }
    // dd($lineItems);

    $orderData = [
        'receipt' => 'order_rcptid_' . uniqid(),
        'amount' => $totalAmount, 
        'currency' => 'INR',
        'payment_capture' => 1 
    ];

    // dd(route('checkout.success',[],true), route('checkout.failure',[],true));
    
    $razorpayOrder = $api->order->create($orderData);
    $orderId = $razorpayOrder['id'];
    return view('checkout', [
        'order_id' => $orderId,
        'amount' => $totalAmount,
        'razorpay_key' => config('services.razorpay.key'),
        'lineItems' => $lineItems,
        'success_url' => route('checkout.success',[],true),  // Success URL
        'failure_url' => route('checkout.failure',[],true)   
    ]);
}
    public function success(Request $request)
    {
        dd($request->all());
    }

    public function fail(Request $request)
    {
        dd($request->all());
    }
    
}
