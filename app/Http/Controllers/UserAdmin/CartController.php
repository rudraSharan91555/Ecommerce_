<?php

namespace App\Http\Controllers\UserAdmin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Cart;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;

class CartController extends Controller
{

    public function index()
    {
        // $cartItems = Cart::getCartItems();

        // $ids = Arr::pluck($cartItems, 'product_id');
        // $products = Product::query()->whereIn('id', $ids)->get();
        // $cartItems = Arr::keyBy($cartItems, 'product_id');

        // $products = $this->getProductsAndCartItems();
        list($products, $cartItems) = Cart::getProductsAndCartItems();

        $total = 0;
        foreach ($products as $product) {
            $total += $product->price * $cartItems[$product->id]['quantity'];
        }
        return view('cart.index', compact('cartItems', 'products', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $quantity = $request->post('quantity', 1);
        $user = $request->user();
        if ($user) {
            // $cartItem = CartItem::where('user_id', $user->id, 'product_id', $product->id)->first();
            $cartItem = CartItem::where([
                'user_id' => $user->id,
                'product_id' => $product->id
            ])->first();

            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->update();
            } else {
                $data = [
                    // 'user_id' => $user()->id,
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity
                ];
                CartItem::create($data);
            }
            return response([
                'count' => Cart::getCartItemsCount()
            ]);
        } else {
            $cartItems = json_decode($request->cookie('cart_items', '[]'), true);
            $productFound = false;
            foreach ($cartItems as &$item) {
                if ($item['product_id'] === $product->id) {
                    $item['quantity'] += $quantity;
                    $productFound = true;
                    break;
                }
            }
            if (!$productFound) {
                $cartItems[] = [
                    'user_id' => null,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price
                ];
            }
            Cookie::queue('cart_items', json_encode($cartItems), 60 * 24 * 30);
            return response(['count' => Cart::getCountFromItems($cartItems)]);
        }
    }

    public function remove(Request $request, Product $product)
    {
        $user = $request->user();
        if ($user) {
            $cartItem = CartItem::query()->where(['user_id' => $user->id, 'product_id' => $product->id])->first();
            if ($cartItem) {
                $cartItem->delete();
            }
            return response([
                'count' => Cart::getCartItemsCount(),
            ]);
        } else {
            $cartItems = json_decode($request->cookie('cart_items', '[]'), true);
            foreach ($cartItems as $i => &$item) {
                if ($item['product_id'] === $product->id) {
                    array_splice($cartItems, $i, 1);
                    break;
                }
            }
            Cookie::queue('cart_items', json_encode($cartItems), 60 * 24 * 7);
            return response([
                'count' => Cart::getCountFromItems($cartItems),
            ]);
        }
    }

    public function updateQuantity(Request $request, Product $product)
    {
        $quantity = (int)$request->post('quantity', 1);
        $user = $request->user();
        if ($user) {
            CartItem::where(['user_id' => $request->user()->id, 'product_id' => $product->id])->update(['quantity' => $quantity]);
            return response([
                'count' => Cart::getCartItemsCount(),
            ]);
        } else {
            $cartItems = json_decode($request->cookie('cart_items', '[]'), true);
            foreach ($cartItems as &$item) {
                if ($item['product_id'] === $product->id) {
                    $item['quantity'] = $quantity;
                    break;
                }
            }
            Cookie::queue('cart_items', json_encode($cartItems), 60 * 24 * 30);
            return response(['count' => Cart::getCountFromItems($cartItems)]);
        }
    }

// public function checkout(Request $request)
// {
//     $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

//     list($products, $cartItems) = $this->getProductsAndCartItems();

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
//     // dd($lineItems);

//     $orderData = [
//         'receipt' => 'order_rcptid_' . uniqid(),
//         'amount' => $totalAmount, 
//         'currency' => 'INR',
//         'payment_capture' => 1 
//     ];

    
//     $razorpayOrder = $api->order->create($orderData);
//     $orderId = $razorpayOrder['id'];
//     return view('checkout', [
//         'order_id' => $orderId,
//         'amount' => $totalAmount,
//         'razorpay_key' => config('services.razorpay.key'),
//         'lineItems' => $lineItems  
//     ]);
// }

// private function getProductsAndCartItems(): array 
// {
//     $cartItems = Cart::getCartItems();
//     $ids = Arr::pluck($cartItems, 'product_id');
//     $products = Product::query()->whereIn('id', $ids)->get();
//     $cartItems = Arr::keyBy($cartItems, 'product_id');

//     return [$products, $cartItems];
// }


}
