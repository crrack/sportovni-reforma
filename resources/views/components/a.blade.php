@props(['href' => null])

<a 
    href="{{ $href }}"
    @click="event.preventDefault();$dispatch('fill', '{{ $href }}');"
    {{ $attributes }}
>
    {{ $slot }}
</a>