
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Checkout
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto bg-white shadow-md rounded-xl p-6 space-y-6">

            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left font-semibold text-gray-700 border-b">Product</th>
                            <th class="px-4 py-2 text-left font-semibold text-gray-700 border-b">Quantity</th>
                            <th class="px-4 py-2 text-left font-semibold text-gray-700 border-b">Price</th>
                            <th class="px-4 py-2 text-left font-semibold text-gray-700 border-b">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lineItems as $item)
                            <tr class="border-b">
                                <td class="px-4 py-2 flex items-center space-x-8">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded">
                                    <span>{{ $item['name'] }}</span>
                                </td>
                                <td class="px-4 py-2 text-center">{{ $item['quantity'] }}</td>
                                <td class="px-4 py-2 text-center">₹{{ number_format($item['unit_amount'] / 100, 2) }}</td>
                                <td class="px-4 py-2 text-center">₹{{ number_format($item['unit_amount'] * $item['quantity'] / 100, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-right py-4">
                <h3 class="text-xl font-semibold text-gray-800">Total Amount: ₹{{ $amount / 100 }}</h3>
            </div>

            <div class="text-center pt-6">
                <x-thirdy-button id="rzp-button" 
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded transition duration-300">
                    Pay ₹{{ $amount / 100 }} with Razorpay
                </x-thirdy-button>
            </div>

            <form name="razorpayform" action="{{ route('checkout.success') }}" method="post">
                @csrf
                <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
                <input type="hidden" name="razorpay_signature" id="razorpay_signature">
            </form>

        </div>   
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var options = {
            "key": "{{ $razorpay_key }}",
            "amount": "{{ $amount }}",
            "currency": "INR",
            "name": "E-commerce Store",
            "description": "Order Payment",
            "order_id": "{{ $order_id }}",
            "handler": function (response) {
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                document.getElementById('razorpay_signature').value = response.razorpay_signature;
                // On successful payment, submit the form
                document.razorpayform.submit();
            },
            "theme": {
                "color": "#4f46e5"
            }
        };

        var rzp1 = new Razorpay(options);

        document.getElementById('rzp-button').onclick = function (e) {
            rzp1.open();
            e.preventDefault();
        }
    </script>
</x-app-layout>
