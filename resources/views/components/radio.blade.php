@props(['click' => null, 'condition' => null, 'right' => null])

<div 
    @click="{{ $click }}" 
    class="flex items-center px-6 bg-white border-2 border-transparent cursor-pointer group h-14"
    :class="{
        'text-black': {{ $condition }},
        'text-gray-500 hover:text-gray-600': !({{ $condition }})
    }"
    {{ $attributes }}
>
    <div 
        class="flex items-center justify-center flex-none w-5 h-5 border-2 rounded-full"
        :class="{
            'border-gray-400': {{ $condition }},
            'border-gray-300 transition duration-300': !({{ $condition }})
        }"
    >
        <div 
            class="w-2.5 h-2.5 bg-black rounded-full"
            :class="{
                'bg-black': {{ $condition }},
                'group-hover:bg-gray-400 transition duration-300': !({{ $condition }})
            }"
        ></div>
    </div>
    <input id="zasilkovna" type="radio" name="shipment" hidden="hidden" value="1">
    <div class="flex items-center justify-between flex-grow ml-6 leading-5">
        <div>
            {{ $slot }}
        </div>
        <div class="text-sm">{{ $right }}</div>
    </div>
</div>