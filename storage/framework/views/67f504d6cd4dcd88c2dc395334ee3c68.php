<h2>
    Your order status was changed into "<?php echo e($order->status); ?>"
</h2>
<p>
    Link to your order:
    <a href="<?php echo e(route('order.view', $order, true)); ?>">Order #<?php echo e($order->id); ?></a>
</p>
  <?php /**PATH C:\Users\rudra\Desktop\Laravel_New\laravel_Ecommerce\resources\views/mail/update-order.blade.php ENDPATH**/ ?>