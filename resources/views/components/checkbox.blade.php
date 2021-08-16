@props(['click' => null, 'condition' => null])

<div 
    @click="{{ $click }}" 
    class="flex items-center h-12 bg-white border-2 border-transparent cursor-pointer group"
    :class="{
        'text-black': {{ $condition }},
        'text-gray-500 hover:text-gray-600': !({{ $condition }})
    }"
>
    <div 
        class="flex items-center justify-center flex-none w-6 h-6 border-2 rounded"
        :class="{
            'border-gray-400': {{ $condition }},
            'border-gray-300': !({{ $condition }})
        }"
    >
        <div 
            class="w-4 h-4 text-white rounded-sm"
            :class="{
                'bg-black': {{ $condition }},
                'group-hover:bg-gray-300 transition duration-300': !({{ $condition }})
            }"
        >
            <svg class="w-5 h-5 -mt-0.5 -ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 13l4 4L18 7"></path>
            </svg>
        </div>
    </div>
    <div class="ml-4">
        {{ $slot }}
    </div>
</div>