<?php

namespace App\Http\Controllers\UserAdmin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;

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
        return view('cart.checkout-success');
    }

    public function fail(Request $request)
    {
        dd($request->all());
    }
}
