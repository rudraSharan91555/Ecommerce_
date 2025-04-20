<?php

namespace App\Http\Controllers\UserAdmin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Cart;
use App\Models\Order;
use App\Models\OrderItem;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;

use function Pest\Laravel\get;

class CheckoutController extends Controller
{

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
        $attributes = [
            'razorpay_order_id' => $input['razorpay_order_id'],
            'razorpay_payment_id' => $input['razorpay_payment_id'],
            'razorpay_signature' => $input['razorpay_signature']
        ];

        // Verify signature
        $api->utility->verifyPaymentSignature($attributes);

        // Payment verification passed
        DB::table('payments')
            ->where('order_id', $input['razorpay_order_id'])
            ->update([
                'status' => 'paid', // You can use an enum or constants for status
                'updated_at' => now(),
            ]);

        // Continue with order creation
        $user = $request->user();
        list($products, $cartItems) = Cart::getProductsAndCartItems();

        $totalAmount = 0;
        foreach ($products as $product) {
            $quantity = $cartItems[$product->id]['quantity'] ?? 1;
            $totalAmount += $product->price * $quantity;
        }

        $order = Order::create([
            'status' => 'paid', // Or your own status
            'total_price' => $totalAmount,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        // Save order items
        foreach ($products as $product) {
            $quantity = $cartItems[$product->id]['quantity'] ?? 1;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'unit_price' => $product->price,
            ]);
        }

        return view('cart.checkout-success')->with('checkout', $input['razorpay_payment_id']);
    } catch (\Exception $e) {
        // Log the error for debugging
        Log::error('Payment verification failed', [
            'error_message' => $e->getMessage(),
            'payment_data' => $input
        ]);

        return view('cart.checkout-failure')->with('error', $e->getMessage());
    }
}


// public function success(Request $request)
// {
//     $input = $request->all();
//     $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

//     try {
//         $attributes = [
//             'razorpay_order_id' => $input['razorpay_order_id'],
//             'razorpay_payment_id' => $input['razorpay_payment_id'],
//             'razorpay_signature' => $input['razorpay_signature']
//         ];

//         // Verify the payment signature
//         $api->utility->verifyPaymentSignature($attributes);

//         // Ensure the user is logged in
//         $userId = auth()->check() ? auth()->user()->id : null;  // Handle guest case

//         // Save the payment details in the database
//         $payment = Payment::create([
//             'order_id' => $input['razorpay_order_id'],
//             'amount' => $input['amount'],
//             'status' => 'paid',  
//             'type' => 'Razorpay',  
//             'razorpay_payment_id' => $input['razorpay_payment_id'],
//             'razorpay_order_id' => $input['razorpay_order_id'],
//             'razorpay_signature' => $input['razorpay_signature'],
//             'created_by' => $userId,
//             'updated_by' => $userId,
//         ]);

//         // Order and order items creation (existing logic)
//         return view('cart.checkout-success')->with('payment', $payment);
        
//     } catch (\Exception $e) {
//         return view('cart.checkout-failure')->with('error', $e->getMessage());
//     }
// }

    
// public function success(Request $request)
// {
//     $input = $request->all();
//     $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

//     try {
//         $attributes = [
//             'razorpay_order_id' => $input['razorpay_order_id'],
//             'razorpay_payment_id' => $input['razorpay_payment_id'],
//             'razorpay_signature' => $input['razorpay_signature']
//         ];

//         // Verify the payment signature
//         $api->utility->verifyPaymentSignature($attributes);

//         // Ensure the user is logged in
//         $userId = auth()->check() ? auth()->user()->id : null;  // Handle guest case

//         // Save the payment details in the database
//         $payment = Payment::create([
//             'order_id' => $input['razorpay_order_id'],
//             'amount' => $input['amount'] ?? 0,  // Make sure the amount is passed correctly
//             'status' => 'paid',  
//             'type' => 'Razorpay',  
//             'razorpay_payment_id' => $input['razorpay_payment_id'],
//             'razorpay_order_id' => $input['razorpay_order_id'],
//             'razorpay_signature' => $input['razorpay_signature'],
//             'created_by' => $userId,
//             'updated_by' => $userId,
//         ]);

//         // Log the payment details for debugging
//         Log::info('Payment Success:', [
//             'payment' => $payment,
//             'input' => $input
//         ]);

//         // Return success view with the payment data
//         return view('cart.checkout-success')->with('payment', $payment);
        
//     } catch (\Exception $e) {
//         Log::error('Payment verification failed:', [
//             'error' => $e->getMessage(),
//             'input' => $input
//         ]);
//         return view('cart.checkout-failure')->with('error', $e->getMessage());
//     }
// }

public function fail(Request $request)
    {
        dd($request->all());
    }
}
