<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'status',
        'amount',
        'total_price', // Add total_price here
        'created_at',
        'updated_at',
    ];

    
}
