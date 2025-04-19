{{-- <!-- resources/views/checkout-success.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Payment Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card text-center shadow p-4">
            <h2 class="text-success mb-3">✅ Payment Successful!</h2>
            <p class="fs-5">Thank you for your purchase. Your order has been placed successfully.</p>
            <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go to Home</a>
        </div>
    </div>
</body>
</html> --}}


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

            <p><strong>Payment ID:</strong> {{ request('payment_id') }}</p>
            <p><strong>Order ID:</strong> {{ request('order_id') }}</p>

            <a href="{{ url('/') }}" class="btn btn-primary mt-4">Continue Shopping</a>
        </div>
    </div>

</body>
</html>
