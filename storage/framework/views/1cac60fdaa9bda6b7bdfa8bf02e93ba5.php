<?php
/** @var \Illuminate\Database\Eloquent\Collection $orders */
?>

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
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b">
                        <td class="py-1 px-2">
                            <a
                                href="<?php echo e(route('order.view', $order)); ?>"
                                class="text-purple-600 hover:text-purple-500"
                            >
                                #<?php echo e($order->id); ?>

                            </a>
                        </td>
                        <td class="py-1 px-2 whitespace-nowrap"><?php echo e($order->created_at); ?></td>
                        <td class="py-1 px-2">
                            <small class="text-white py-1 px-2 rounded
                                <?php echo e($order->isPaid() ? 'bg-emerald-500' : 'bg-gray-400'); ?>">
                                <?php echo e($order->status); ?>

                            </small>
                        </td>
                        <td class="py-1 px-2">Rs.<?php echo e($order->total_price); ?></td>
                        <td class="py-1 px-2 whitespace-nowrap"><?php echo e($order->items_count); ?> item(s)</td>
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
                                                <h2>Invoice for Order #<?php echo e($order->id); ?></h2>
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
                            
                             <?php if(!$order->isPaid() && !in_array($order->status, ['cancelled', 'shipped', 'complete'])): ?>
                                <form action="<?php echo e(route('cart.checkout-order', $order)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
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
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <?php echo e($orders->links()); ?>

        </div>
    </div>
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
<?php /**PATH C:\Users\rudra\Desktop\Laravel_New\laravel_Ecommerce\resources\views/order/index.blade.php ENDPATH**/ ?>