<?php
/** @var \Illuminate\Database\Eloquent\Collection $orders */
?>

<x-app-layout>
    <div class="container mx-auto lg:w-2/3 p-5">
        <h1 class="text-3xl font-bold mb-2">My Orders</h1>
        <div class="bg-white rounded-lg p-3 overflow-x-auto">
            <table class="table-auto w-full">
                <thead>
                <tr class="border-b-2">
                    <th class="text-left p-2">Order #</th>
                    <th class="text-left p-2">Date</th>
                    <th class="text-left p-2">Status</th>
                    <th class="text-left p-2">SubTotal</th>
                    <th class="text-left p-2">Items</th>
                    <th class="text-left p-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr class="border-b">
                        <td class="py-1 px-2">
                            <a
                                href="{{ route('order.view', $order) }}"
                                class="text-purple-600 hover:text-purple-500"
                            >
                                #{{$order->id}}
                            </a>
                        </td>
                        <td class="py-1 px-2 whitespace-nowrap">{{$order->created_at}}</td>
                        <td class="py-1 px-2">
                            <small class="text-white py-1 px-2 rounded
                                {{$order->isPaid() ? 'bg-emerald-500' : 'bg-gray-400' }}">
                                {{$order->status}}
                            </small>
                        </td>
                        <td class="py-1 px-2">Rs.{{$order->total_price}}</td>
                        <td class="py-1 px-2 whitespace-nowrap">{{$order->items_count}} item(s)</td>
                        <td class="py-1 px-2 flex gap-2 w-[180px]">
                            <!-- Invoice Button & Modal -->
                            <div x-data="{ open: false }">
                                <template x-teleport="body">
                                    <div x-show="open"
                                        class="fixed flex justify-center items-center left-0 top-0 bottom-0 right-0 z-10 bg-black/80">
                                        <div x-show="open" x-transition @click.outside="open = false"
                                            class="w-[90%] md:w-1/2 bg-white rounded-lg">
                                            <div
                                                class="py-2 px-4 text-lg font-semibold bg-gray-100 rounded-t-lg flex items-center justify-between">
                                                <h2>Invoice for Order #{{ $order->id }}</h2>
                                                <button @click="open = false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="p-4">
                                                Invoice Content
                                            </div>
                                            <div
                                                class="py-2 px-4 text-lg flex justify-end font-semibold bg-gray-100 rounded-b-lg">
                                                <button @click="open = false"
                                                    class="inline-flex items-center py-1 px-3 bg-gray-300 hover:bg-opacity-95 text-gray-800 rounded-md shadow">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <!-- Payment Button -->
                            {{-- @if (!$order->isPaid())
                                <form action="{{ route('cart.checkout-order', $order) }}"
                                      method="POST">
                                    @csrf
                                    <button
                                        class="flex items-center py-1 btn-primary whitespace-nowrap">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"
                                            />
                                        </svg>
                                        Pay
                                    </button>
                                </form>
                            @endif --}}
                             @if (!$order->isPaid() && !in_array($order->status, ['cancelled', 'shipped', 'complete']))
                                <form action="{{ route('cart.checkout-order', $order) }}" method="POST">
                                    @csrf
                                    <button class="flex items-center py-1 btn-primary whitespace-nowrap">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="h-5 w-5" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor"
                                             stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                        </svg>
                                        Pay
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $orders->links() }}
        </div>
    </div>
</x-app-layout>
