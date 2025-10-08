
<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Checkout
        </h2>
     <?php $__env->endSlot(); ?>

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
                        <?php $__currentLoopData = $lineItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-b">
                                <td class="px-4 py-2 flex items-center space-x-8">
                                    <img src="<?php echo e($item['image']); ?>" alt="<?php echo e($item['name']); ?>" class="w-16 h-16 object-cover rounded">
                                    <span><?php echo e($item['name']); ?></span>
                                </td>
                                <td class="px-4 py-2 text-center"><?php echo e($item['quantity']); ?></td>
                                <td class="px-4 py-2 text-center">₹<?php echo e(number_format($item['unit_amount'] / 100, 2)); ?></td>
                                <td class="px-4 py-2 text-center">₹<?php echo e(number_format($item['unit_amount'] * $item['quantity'] / 100, 2)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <div class="text-right py-4">
                <h3 class="text-xl font-semibold text-gray-800">Total Amount: ₹<?php echo e($amount / 100); ?></h3>
            </div>

            <div class="text-center pt-6">
                <?php if (isset($component)) { $__componentOriginaldbaa5f77158c4462136e9fc636624168 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldbaa5f77158c4462136e9fc636624168 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.thirdy-button','data' => ['id' => 'rzp-button','class' => 'bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded transition duration-300']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('thirdy-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'rzp-button','class' => 'bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded transition duration-300']); ?>
                    Pay ₹<?php echo e($amount / 100); ?> with Razorpay
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldbaa5f77158c4462136e9fc636624168)): ?>
<?php $attributes = $__attributesOriginaldbaa5f77158c4462136e9fc636624168; ?>
<?php unset($__attributesOriginaldbaa5f77158c4462136e9fc636624168); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldbaa5f77158c4462136e9fc636624168)): ?>
<?php $component = $__componentOriginaldbaa5f77158c4462136e9fc636624168; ?>
<?php unset($__componentOriginaldbaa5f77158c4462136e9fc636624168); ?>
<?php endif; ?>
            </div>

            <form name="razorpayform" action="<?php echo e(route('checkout.success')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
                <input type="hidden" name="razorpay_signature" id="razorpay_signature">
            </form>

        </div>   
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var options = {
            "key": "<?php echo e($razorpay_key); ?>",
            "amount": "<?php echo e($amount); ?>",
            "currency": "INR",
            "name": "E-commerce Store",
            "description": "Order Payment",
            "order_id": "<?php echo e($order_id); ?>",
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\rudra\Desktop\Laravel_New\laravel_Ecommerce\resources\views/checkout.blade.php ENDPATH**/ ?>