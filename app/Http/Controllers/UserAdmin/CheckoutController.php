<?php

namespace App\Http\Controllers\UserAdmin;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Cart;
use App\Mail\NewOrderEmail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        list($products, $cartItems) = Cart::getProductsAndCartItems();

        $orderItems = [];
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

        $razorpayOrder = $api->order->create($orderData);
        $orderId = $razorpayOrder['id'];

        $sessionId = uniqid();

        session(['razorpay_session_id' => $sessionId]);

        DB::table('payments')->insert([
            'order_id' => $orderId,
            'amount' => $totalAmount / 100,
            'status' => OrderStatus::Unpaid,
            'type' => 'standard',
            'session_id' => $sessionId,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => $user->id,
            'updated_by' => $user->id,
            'total_price' => $totalAmount / 100,
        ]);

        Log::info('Payment record created', [
            'order_id' => $orderId,
            'amount' => $totalAmount,
        ]);

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
            $api->utility->verifyPaymentSignature($attributes);

            DB::table('payments')
                ->where('order_id', $input['razorpay_order_id'])
                ->update([
                    'status' => 'paid',
                    'razorpay_payment_id' => $input['razorpay_payment_id'],
                    'razorpay_order_id' => $input['razorpay_order_id'],
                    'razorpay_signature' => $input['razorpay_signature'],
                    'updated_at' => now(),
                ]);

            Log::info('Payment updated successfully', $input);

            $user = $request->user();
            list($products, $cartItems) = Cart::getProductsAndCartItems();

            $totalAmount = 0;
            foreach ($products as $product) {
                $quantity = $cartItems[$product->id]['quantity'] ?? 1;
                $totalAmount += $product->price * $quantity;
            }

            $order = Order::create([
                'status' => 'paid',
                'total_price' => $totalAmount,
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ]);

            foreach ($products as $product) {
                $quantity = $cartItems[$product->id]['quantity'] ?? 1;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $product->price,
                ]);
            }

            $payment = Payment::where('razorpay_payment_id', $input['razorpay_payment_id'])->first();
            Cart::clear();
            $this->sendOrderConfirmationEmails($order);
            return view('cart.checkout-success', [
                'payment' => $payment,
                'userName' => $user->name
            ]);
        } catch (\Exception $e) {
            Log::error('Payment verification failed', [
                'error_message' => $e->getMessage(),
                'payment_data' => $input
            ]);

            return view('cart.checkout-failure')->with('error', $e->getMessage());
        }
    }

    public function fail(Request $request)
    {

        return view('checkout.failure', ['message' => ""]);
    }

    public function checkoutOrder(Order $order, Request $request)
    {
        $user = $request->user();

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $lineItems = [];
        $totalAmount = 100; 

        foreach ($order->items as $item) {
            $amount = $item->unit_price * 100; 
            $quantity = $item->quantity;

            
            $totalAmount = 100; 
            $lineItems[] = [
                'name' => $item->product->title,
                'quantity' => $quantity,
                'image' => $item->product->image,
                'currency' => 'INR',
                'unit_amount' => $amount,
            ];
        }

        
        $razorpayOrder = $api->order->create([
            'receipt' => 'order_rcptid_' . uniqid(),
            'amount' => $totalAmount, 
            'currency' => 'INR',
            'payment_capture' => 1
        ]);

        $razorpayOrderId = $razorpayOrder['id'];
        $sessionId = uniqid();

        DB::table('payments')->insert([
            'order_id' => $razorpayOrderId,
            'amount' => $totalAmount / 100, 
            'status' => OrderStatus::Unpaid,
            'type' => 'razorpay',
            'session_id' => $sessionId,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => $user->id,
            'updated_by' => $user->id,
            'total_price' => $totalAmount / 100,
        ]);

        if ($order->payment) {
            $order->payment->session_id = $sessionId;
            $order->payment->order_id = $razorpayOrderId;
            $order->payment->save();
        }

        Log::info('Razorpay order created', [
            'order_id' => $razorpayOrderId,
            'amount' => $totalAmount,
        ]);

        return view('checkout', [
            'order_id' => $razorpayOrderId,
            'amount' => $totalAmount / 100,
            'razorpay_key' => config('services.razorpay.key'),
            'lineItems' => $lineItems,
            'success_url' => route('checkout.success', [], true),
            'failure_url' => route('checkout.failure', [], true)
        ]);
    }


    private function updateOrderAndSession(Payment $payment, Order $order)
    {
        DB::beginTransaction();
        try {
            $payment->status = PaymentStatus::Paid->value;
            $payment->update();

            $order->status = OrderStatus::Paid->value;
            $order->update();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::critical(__METHOD__ . ' method does not work. ' . $e->getMessage());
            throw $e;
        }

        DB::commit();

        try {
            $adminUsers = User::where('is_admin', 1)->get();

            foreach ([...$adminUsers, $order->user] as $user) {
                Mail::to($user->email)->send(new NewOrderEmail($order, (bool)$user->is_admin));
            }
        } catch (\Exception $e) {
            Log::critical('Email sending does not work. ' . $e->getMessage());
        }
    }
    private function sendOrderConfirmationEmails(Order $order)
    {
        try {
            $adminUsers = User::where('is_admin', 1)->get();
            foreach ($adminUsers as $admin) {
                Mail::to($admin->email)->send(new NewOrderEmail($order, true));
            }  
            Mail::to($order->user->email)->send(new NewOrderEmail($order, false));
        } catch (\Exception $e) {
            Log::critical('Email sending failed: ' . $e->getMessage());
        }
    }
}
