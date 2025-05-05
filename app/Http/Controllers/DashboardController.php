<?php

namespace App\Http\Controllers;

use App\Enums\CustomerStatus;
use App\Enums\OrderStatus;
use App\Models\Api\Product;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public  function activeCustomers()
    {
        return Customer::where('status',CustomerStatus::Active->value)->count();
    }
    
    public function activeProducts()
    {
        return Product::count();
    }

    public function paidOrders()
    {
        return Order::where('status', OrderStatus::Paid->value)->count();
    }

    public function totalIncome()
    {
        return Order::where('status',OrderStatus::Paid->value)->sum('total_price');
    }
    

}