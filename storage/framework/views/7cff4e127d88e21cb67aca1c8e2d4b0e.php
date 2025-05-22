<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel E-commerce Project')); ?></title>

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    

    <style>
      [x-cloak] {
        display: none !important;
      }
    </style>
  </head>
  <body>
    <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main class="p-5">
     <?php echo e($slot); ?>

    </main>

    <!-- Toast -->
    <div
      x-data="toast"
      x-show="visible"
      x-transition
      x-cloak
      @notify.window="show($event.detail.message)"
      class="fixed w-[400px] left-1/2 -ml-[200px] top-16 py-2 px-4 pb-4 bg-red-500 text-white"
      :class="type === 'success' ? 'bg-emerald-500' : 'bg-red-500'"
    >
      <div class="font-semibold" x-text="message"></div>
      <button
        @click="close"
        class="absolute flex items-center justify-center right-2 top-2 w-[30px] h-[30px] rounded-full hover:bg-black/10 transition-colors"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          stroke-width="2"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M6 18L18 6M6 6l12 12"
          />
        </svg>
      </button>
      <!-- Progress -->
      <div>
        <div
          class="absolute left-0 bottom-0 right-0 h-[6px] bg-black/10"
          :style="{'width': `${percent}%`}"
        ></div>
      </div>
    </div>
    <!--/ Toast -->
  </body>
</html>
<?php /**PATH C:\Users\rudra\Desktop\Laravel_New\laravel_Ecommerce\resources\views/layouts/app.blade.php ENDPATH**/ ?>