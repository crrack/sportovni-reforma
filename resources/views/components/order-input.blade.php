@props(['size' => 6, 'name', 'placeholder' => null, 'tracking' => false])

<div class="col-span-{{ $size }}">
    <input 
        type="text" 
        @if($tracking) x-on:change="fillOrder" @endif
        x-model="form.{{ $name }}"
        placeholder="{{ $placeholder }}"
        class="border-2 rounded px-3 py-1.5 w-full focus:border-gray-900 focus:outline-none placeholder"
    >
</div>