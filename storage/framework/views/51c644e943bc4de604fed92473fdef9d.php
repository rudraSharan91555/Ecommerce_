<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'disabled' => false,
    'errors',
    'type' => 'text',
    'label' => false
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'disabled' => false,
    'errors',
    'type' => 'text',
    'label' => false
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \Illuminate\View\ComponentAttributeBag  $attributes */
$errorClasses = 'border-red-500 focus:border-red-500 ring-1 ring-red-500 focus:ring-red-500';
$defaultClasses = 'border-gray-300 focus:border-purple-600 focus:ring-purple-600';
$successClasses = 'border-emerald-500 focus:border-emerald-500 ring-1 ring-emerald-500 focus:ring-emerald-500';

$attributeName = preg_replace('/(\w+)\[(\w+)]/', '$1.$2', $attributes['name']);
?>

<div class="mb-4">
    <?php if($label): ?>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            <?php echo e($label); ?>

        </label>
    <?php endif; ?>

    <?php if($type === 'select'): ?>
        <select 
            <?php echo e($disabled ? 'disabled' : ''); ?>

            <?php echo $attributes->merge([
                'class' => 
                "block w-full rounded-2xl border p-2.5 text-sm shadow-sm transition 
                placeholder-gray-400 focus:outline-none " .
                ($errors->has($attributeName) ? $errorClasses : (old($attributeName) ? $successClasses : $defaultClasses))
            ]); ?>>
            <?php echo e($slot); ?>

        </select>
    <?php else: ?>
        <input 
            <?php echo e($disabled ? 'disabled' : ''); ?>

            type="<?php echo e($type); ?>"
            <?php echo $attributes->merge([
                'class' => 
                "block w-full rounded-2xl border p-2.5 text-sm shadow-sm transition 
                placeholder-gray-400 focus:outline-none " .
                ($errors->has($attributeName) ? $errorClasses : (old($attributeName) ? $successClasses : $defaultClasses))
            ]); ?>>
    <?php endif; ?>

    <?php $__errorArgs = [$attributeName];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <small class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></small>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<?php /**PATH C:\Users\rudra\Desktop\Laravel_New\laravel_Ecommerce\resources\views/components/input.blade.php ENDPATH**/ ?>