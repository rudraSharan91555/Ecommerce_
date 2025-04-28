<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public static $wrap = false;

    public function toArray($request)
    {
        $customer = optional(optional($this->user)->customer);
        $shipping = optional($customer->shippingAddress);
        $billing = optional($customer->billingAddress);

        return [
            'id' => $this->id,
            'status' => $this->status,
            'total_price' => $this->total_price,
            'items' => $this->items->map(function ($item) {
                $product = optional($item->product);
                return [
                    'id' => $item->id,
                    'unit_price' => $item->unit_price,
                    'quantity' => $item->quantity,
                    'product' => [
                        'id' => $product->id,
                        'slug' => $product->slug,
                        'title' => $product->title,
                        'image' => $product->image,
                    ]
                ];
            }),
            'customer' => [
                'id' => optional($this->user)->id,
                'email' => optional($this->user)->email,
                'first_name' => $customer->first_name,
                'last_name' => $customer->last_name,
                'phone' => $customer->phone,
                'shippingAddress' => [
                    'id' => $shipping->id,
                    'address1' => $shipping->address1,
                    'address2' => $shipping->address2,
                    'city' => $shipping->city,
                    'state' => $shipping->state,
                    'zipcode' => $shipping->zipcode,
                    'country' => optional($shipping->country)->name,
                ],
                'billingAddress' => [
                    'id' => $billing->id,
                    'address1' => $billing->address1,
                    'address2' => $billing->address2,
                    'city' => $billing->city,
                    'state' => $billing->state,
                    'zipcode' => $billing->zipcode,
                    'country' => optional($billing->country)->name,
                ],
            ],
            'created_at' => optional($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => optional($this->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}