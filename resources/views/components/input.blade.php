@props([
    'disabled' => false,
    'errors',
    'type' => 'text',
    'label' => false
])

<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \Illuminate\View\ComponentAttributeBag  $attributes */
$errorClasses = 'border-red-500 focus:border-red-500 ring-1 ring-red-500 focus:ring-red-500';
$defaultClasses = 'border-gray-300 focus:border-purple-600 focus:ring-purple-600';
$successClasses = 'border-emerald-500 focus:border-emerald-500 ring-1 ring-emerald-500 focus:ring-emerald-500';

$attributeName = preg_replace('/(\w+)\[(\w+)]/', '$1.$2', $attributes['name']);
?>

<div class="mb-4">
    @if ($label)
        <label class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
        </label>
    @endif

    @if ($type === 'select')
        <select 
            {{ $disabled ? 'disabled' : '' }}
            {!! $attributes->merge([
                'class' => 
                "block w-full rounded-2xl border p-2.5 text-sm shadow-sm transition 
                placeholder-gray-400 focus:outline-none " .
                ($errors->has($attributeName) ? $errorClasses : (old($attributeName) ? $successClasses : $defaultClasses))
            ]) !!}>
            {{ $slot }}
        </select>
    @else
        <input 
            {{ $disabled ? 'disabled' : '' }}
            type="{{ $type }}"
            {!! $attributes->merge([
                'class' => 
                "block w-full rounded-2xl border p-2.5 text-sm shadow-sm transition 
                placeholder-gray-400 focus:outline-none " .
                ($errors->has($attributeName) ? $errorClasses : (old($attributeName) ? $successClasses : $defaultClasses))
            ]) !!}>
    @endif

    @error($attributeName)
        <small class="text-red-600 text-sm mt-1 block">{{ $message }}</small>
    @enderror
</div>
