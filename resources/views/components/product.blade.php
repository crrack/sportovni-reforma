@props(['title', 'price', 'availability' => 'Skladem', 'thumbnail', 'slug'])

<x-a href="/produkt/{{ $slug }}" class="flex flex-col flex-none w-64 px-3 my-2 -ml-px bg-white border-l border-r cursor-pointer product">
    <div class="relative px-2">
        <div class="absolute right-0 flex flex-col items-end space-y-3 font-semibold top-2">
            {{-- <div class="px-4 py-1 text-green-800 bg-green-400">
                Novinka
            </div>
            <div class="px-4 py-1 text-yellow-700 bg-yellow-300">
                Sleva
            </div>  --}}
        </div>
        <img class="object-cover object-center w-full bg-gray-900" src="{{ $thumbnail['static'] }}" style="height: 18rem;">
    </div>
    <div class="relative px-2">
        <div class="flex flex-wrap items-center justify-between mt-4">
            <div class="mb-1 text-lg">{{ $title }}</div>
            <div class="text-lg font-bold">
                {{ $price }} Kč
            </div> 
        </div>
        <p class="mb-2 text-sm">
            {!! $availability !!}
        </p>
        <div class="inset-x-0 bottom-0 transition duration-700 bg-white lg:absolute product-btn lg:opacity-0">
            <span
                class="block w-full py-4 font-medium text-center text-white transition duration-300 bg-black hover:text-white hover:bg-red-600"
            >
                Detail produktu
            </span>
        </div>
    </div>
</x-a>