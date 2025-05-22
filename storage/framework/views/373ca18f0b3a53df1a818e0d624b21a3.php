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
    <!-- Product List -->
    <div
    class="grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 p-5"
  >
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <!-- Product Item -->
    <div
      x-data="productItem(<?php echo e(json_encode([
        'id' => $product->id,
        'title' => $product->title,
        'image' => $product->image ?: '/img/noimage.png',
        'price' => $product->price,
        'addToCartUrl' => route('cart.add', $product),
      ] )); ?>)"
      class="border border-1 border-gray-200 rounded-md hover:border-purple-600 transition-colors bg-white"
    >
      <a href="<?php echo e(route('product.view',$product->slug)); ?>" class="block overflow-hidden aspect-w-3 aspect-h-2">
        <img
          src="<?php echo e($product->image ?: '/img/noimage.png'); ?>"
          alt=""
          class="rounded-lg hover:scale-105 hover:rotate-1 transition-transform object-cover "
        />
      </a>
      <div class="p-4">
        <h3 class="text-lg">
          <a href="<?php echo e(route('product.view',$product->slug)); ?>">
            <?php echo e($product->title); ?>

          </a>
        </h3>
        <h5 class="font-bold">Rs <?php echo e($product->price); ?></h5>
      </div>
      <div class="flex justify-between py-3 px-4">
        
        <button class="btn-primary" @click="addToCart()">
          Add to Cart
        </button>
      </div>
    </div>
    <!--/ Product Item -->
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php echo e($products->links()); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\rudra\Desktop\Laravel_New\laravel_Ecommerce\resources\views/product/index.blade.php ENDPATH**/ ?>