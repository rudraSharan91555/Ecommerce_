<h1>
    New order has been created
</h1>

<table>
    <tr>
        <th>Order ID</th>
        <td>
            <a href="<?php echo e($forAdmin ? env('BACKEND_URL').'/app/orders/'.$order->id : route('order.view', $order, true)); ?>">
                <?php echo e($order->id); ?>

            </a>
        </td>
    </tr>
    <tr>
        <th>Order Status</th>
        <td><?php echo e($order->status); ?></td>
    </tr>
    <tr>
        <th>Order Price</th>
        <td>Rs<?php echo e($order->total_price); ?></td>
    </tr>
    <tr>
        <th>Order Date</th>
        <td><?php echo e($order->created_at); ?></td>
    </tr>
</table>
<table>
    <tr>
        <th>Image</th>
        <th>Title</th>
        <th>Price</th>
        <th>Quantity</th>
    </tr>
    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>
                <img src="<?php echo e($item->product->image); ?>" style="width: 100px">
            </td>
            <td><?php echo e($item->product->title); ?></td>
            <td>Rs <?php echo e($item->unit_price * $item->quantity); ?></td>
            <td><?php echo e($item->quantity); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
<?php /**PATH C:\Users\rudra\Desktop\Laravel_New\laravel_Ecommerce\resources\views/mail/new-order.blade.php ENDPATH**/ ?>