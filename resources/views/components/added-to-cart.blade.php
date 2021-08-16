<div 
    x-show="addedToCart" 
    class="fixed top-0 left-0 z-40 flex items-center justify-center w-full h-full"
    style="display: none"
>
    <div @click="addedToCart = false" class="absolute w-full h-full bg-gray-900 opacity-70 modal-overlay"></div>
    
    <div class="z-50 w-11/12 mx-auto overflow-y-auto bg-white rounded shadow-lg modal-container md:max-w-lg">
        <div @click="addedToCart = false" class="absolute z-50 flex flex-col items-center text-white cursor-pointer top-4 right-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
        <div class="p-8 text-left modal-content">
            <div class="flex items-center justify-between pb-3">
                <p class="text-2xl font-bold">Produkt přidán do košíku!</p>
                <div @click="addedToCart = false" class="cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            </div>
            <p>Produkt byl úspěšně přidán do košíku.</p>
            <div class="flex pt-6 mx-auto">
                <x-a href="/kosik" class="block px-8 py-4 font-medium text-center text-white duration-200 bg-red-600 transtaion hover:bg-black">
                    Zobrazit košík
                </x-a>
                <button @click="addedToCart = false" type="button" class="block px-8 py-4 font-medium text-center text-black bg-transparent hover:text-red-600">
                    Zavřít
                </button>
            </div>
        </div>
    </div>
</div>