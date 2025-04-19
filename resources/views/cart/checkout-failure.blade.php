<!DOCTYPE html>
<html>
<head>
    <title>Payment Failed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fa;
        }
        .failed-card {
            max-width: 500px;
            margin: 100px auto;
            padding: 30px;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .failed-title {
            color: #dc3545;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="failed-card text-center">
            <h2 class="failed-title">Payment Failed ❌</h2>
            <p class="mt-3">Sorry! Your payment didn’t go through.</p>

            <p><strong>Reason:</strong> {{ $error_message ?? 'Transaction was declined or cancelled.' }}</p>

            <a href="{{ url('/payment') }}" class="btn btn-danger mt-4">Retry Payment</a>
        </div>
    </div>

</body>
</html>
