{{-- <!DOCTYPE html>
<html>
<head>
    <title>Payment Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fa;
        }
        .success-card {
            max-width: 500px;
            margin: 100px auto;
            padding: 30px;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .success-title {
            color: #28a745;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="success-card text-center">
            <h2 class="success-title">Payment Successful 🎉</h2>
            <p class="mt-3">Thank you! Your payment has been received.</p>
            
            <p><strong>Payment ID:</strong> {{ $payment->id ?? 'Not Available' }}</p>
            <p><strong>Order ID:</strong> {{ $payment->order_id ?? 'Not Available' }}</p>


            <a href="{{ url('/') }}" class="btn btn-primary mt-4">Continue Shopping</a>
        </div>
        <form method="POST" action="{{ route('checkout.success') }}" id="payment-form">
    @csrf
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
    <input type="hidden" name="razorpay_signature" id="razorpay_signature">
</form>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "{{ $razorpay_key }}",
        "amount": "{{ $amount }}",
        "currency": "INR",
        "name": "Apna Store",
        "description": "Test Transaction",
        "order_id": "{{ $order_id }}", 
        "handler": function (response){
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
            document.getElementById('razorpay_signature').value = response.razorpay_signature;

            document.getElementById('payment-form').submit();
        },
        "theme": {
            "color": "#3399cc"
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.open();
</script>
<form method="POST" action="{{ route('checkout.success') }}" id="payment-form">
    @csrf
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
    <input type="hidden" name="razorpay_signature" id="razorpay_signature">
</form>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "{{ $razorpay_key }}",
        "amount": "{{ $amount }}",
        "currency": "INR",
        "name": "Apna Store",
        "description": "Test Transaction",
        "order_id": "{{ $order_id }}", // Razorpay order ID from backend
        "handler": function (response){
            // Populate hidden fields and submit form
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
            document.getElementById('razorpay_signature').value = response.razorpay_signature;

            document.getElementById('payment-form').submit();
        },
        "theme": {
            "color": "#3399cc"
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.open();
</script>

    </div>

</body>
</html>
 --}}
 <!DOCTYPE html>
 <html>
 <head>
     <title>Payment Success</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <style>
         body {
             background-color: #f5f7fa;
         }
         .success-card {
             max-width: 500px;
             margin: 100px auto;
             padding: 30px;
             border-radius: 10px;
             background-color: white;
             box-shadow: 0 5px 20px rgba(0,0,0,0.1);
         }
         .success-title {
             color: #28a745;
             font-weight: 600;
         }
     </style>
 </head>
 <body>
 
     <div class="container">
         <div class="success-card text-center">
             <h2 class="success-title">Payment Successful 🎉</h2>
             <p class="mt-3">Thank you! Your payment has been received.</p>
 
             <p><strong>Payment ID:</strong> {{ $payment->id ?? 'Not Available' }}</p>
             <p><strong>Order ID:</strong> {{ $payment->order_id ?? 'Not Available' }}</p>
 
             <a href="{{ url('/') }}" class="btn btn-primary mt-4">Continue Shopping</a>
         </div>
     </div>
 
 </body>
 </html>
 