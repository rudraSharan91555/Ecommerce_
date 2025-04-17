{{-- @props([
    'type' => 'text',
    'name',
    'label' => null,
    'value' => '',
    'placeholder' => '',
])

<div class="mb-3">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
        </label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'w-full border-gray-300 rounded focus:ring-purple-600 focus:border-purple-600']) }}
    >

    @error($name)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div> --}}
@props([
    'type' => 'text',
    'name',
    'label' => null,
    'value' => '',
    'placeholder' => '',
    'autocomplete' => null
])

<div class="mb-3">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
        </label>
    @endif

    @if($type === 'select')
        <select
            name="{{ $name }}"
            id="{{ $name }}"
            {{ $attributes->merge(['class' => 'w-full border-gray-300 rounded focus:ring-purple-600 focus:border-purple-600']) }}
        >
            {{ $slot }}
        </select>
    @else
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $name }}"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            autocomplete="{{ $autocomplete }}"
            {{ $attributes->merge(['class' => 'w-full border-gray-300 rounded focus:ring-purple-600 focus:border-purple-600']) }}
        />
    @endif

    @error($name)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>
