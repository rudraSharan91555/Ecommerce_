<?php

namespace App\Http\Controllers\UserAdmin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;

use function Pest\Laravel\get;

class CheckoutController extends Controller
{
    // public function checkout(Request $request)
    // {
    //     /** @var \App\Models\User $user */
    //     $user = $request->user();

    //     $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

    //     list($products, $cartItems) = Cart::getProductsAndCartItems();

    //     $totalAmount = 0;
    //     $lineItems = [];
    //     foreach ($products as $product) {
    //         $quantity = $cartItems[$product->id]['quantity'] ?? 1;
    //         $totalAmount += $product->price * $quantity * 100;
    //         $lineItems[] = [
    //             'name' => $product->title,
    //             'quantity' => $quantity,
    //             'image' => $product->image,
    //             'currency' => 'INR',
    //             'unit_amount' => $product->price * 100,
    //         ];
    //     }

    //     $orderData = [
    //         'receipt' => 'order_rcptid_' . uniqid(),
    //         'amount' => $totalAmount,
    //         'currency' => 'INR',
    //         'payment_capture' => 1
    //     ];

    //     // Razorpay order create
    //     $razorpayOrder = $api->order->create($orderData);
    //     $orderId = $razorpayOrder['id'];

    //     // Optional: if session_id is returned
    //     $sessionId = $razorpayOrder['session_id'] ?? null;

    //     if ($sessionId) {
    //         DB::table('payments')->insert([
    //             'order_id' => $orderId,
    //             'session_id' => $sessionId,
    //             'amount' => $totalAmount,
    //             'status' => OrderStatus::Unpaid,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     }

    //     return view('checkout', [
    //         'order_id' => $orderId,
    //         'amount' => $totalAmount,
    //         'razorpay_key' => config('services.razorpay.key'),
    //         'lineItems' => $lineItems,
    //         'success_url' => route('checkout.success', [], true),
    //         'failure_url' => route('checkout.failure', [], true)
    //     ]);
    // }

    
    public function checkout(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

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

        $orderData = [
            'receipt' => 'order_rcptid_' . uniqid(),
            'amount' => $totalAmount,
            'currency' => 'INR',
            'payment_capture' => 1
        ];

        // Razorpay order create
        $razorpayOrder = $api->order->create($orderData);
        $orderId = $razorpayOrder['id'];

        // Optional: if session_id is returned
        $sessionId = $razorpayOrder['session_id'] ?? null;

        if ($sessionId) {
            DB::table('payments')->insert([
                'order_id' => $orderId,
                'session_id' => $sessionId,
                'amount' => $totalAmount,
                'status' => OrderStatus::Unpaid,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return view('checkout', [
            'order_id' => $orderId,
            'amount' => $totalAmount,
            'razorpay_key' => config('services.razorpay.key'),
            'lineItems' => $lineItems,
            'success_url' => route('checkout.success', [], true),
            'failure_url' => route('checkout.failure', [], true)
        ]);
    }


public function success(Request $request)
{
    $input = $request->all();

    $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

    try {
        // Step 1: Verify signature
        $attributes = [
            'razorpay_order_id' => $input['razorpay_order_id'],
            'razorpay_payment_id' => $input['razorpay_payment_id'],
            'razorpay_signature' => $input['razorpay_signature']
        ];

        $api->utility->verifyPaymentSignature($attributes);

        // Step 2: Payment verified successfully — ab yahan order save kar sakte ho
        // You can also fetch payment details like this (optional):
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        return view('cart.checkout-success', compact('payment'));

    } catch (\Exception $e) {
        return view('cart.checkout-failure')->with('error', $e->getMessage());
    }
}

    // public function success(Request $request)
    // {
    //     return view('cart.checkout-success');
    // }

    // test
    // public function success(Request $request)
    // {
    //     \Razorpay\Razorpay::setApiKey(getenv('RAZORPAY_KEY_ID'));
        
    //     try{
    //         $session_id = $request->get('session_id');
    //         $session = \Razorpay\Checkout::session($session_id);
    //         if(!$session){
    //             return view('cart.checkout-failure');
    //     }
    //     $customer = $session->customer;

    //     return view('cart.checkout-success',compact('customer')); 
    // }catch(\Exception $e){
    //     return view('cart.checkout-failure');
    // }
       
    // }
    // test


    public function fail(Request $request)
    {
        dd($request->all());
    }
}
