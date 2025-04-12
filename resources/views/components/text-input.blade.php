@props(['disabled' => false])

{{-- @props(['disabled' => false,'errors','label' => false])

@if ($label)
 <label>{{$label}}</label>    
@endif --}}

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
