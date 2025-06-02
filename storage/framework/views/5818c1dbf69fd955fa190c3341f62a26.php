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
            <h2 class="success-title"> <?php echo e($userName); ?> Payment Successful 🎉</h2>
            <p class="mt-3">Thank you! Your payment has been received.</p>
            <p class="mt-3">Your order has been placed successfully.</p>
            <p><strong>Payment ID:</strong> <?php echo e($payment->razorpay_payment_id ?? 'Not Available'); ?></p>
            <p><strong>Order ID:</strong> <?php echo e($payment->order_id ?? 'Not Available'); ?></p>

            <a href="<?php echo e(url('/')); ?>" class="btn btn-primary mt-4">Continue Shopping</a>
        </div>
    </div>

</body>
</html>
<?php /**PATH C:\Users\rudra\Desktop\Laravel_New\laravel_Ecommerce\resources\views/cart/checkout-success.blade.php ENDPATH**/ ?>