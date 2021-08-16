@props([
    'image' => null,
    'item'
])

<tr 
    x-data="{
        quantity: {{ $item['quantity'] }},
        changeQuantity($dispatch, q = this.quantity) {
            fetch('/updateCartItem', {
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json, text-plain, */*',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                method: 'post',
                credentials: 'same-origin',
                body: JSON.stringify({
                    cart: JSON.parse(window.localStorage.getItem('cart')),
                    id: '{{ $item['id'] }}',
                    quantity: q
                })
            }).then((response) => {
                return response.json()
            }).then((response) => {
                window.localStorage.setItem('cart',  JSON.stringify(response.data.cart));
                $dispatch('menu-cart', response.data.cart);
                $dispatch('update-total', response.data.cart.total);
                
                if(response.data.cart.total == 0) {
                    $dispatch('fill', 'kosik?cart=' + response.data.cart.code);
                }
                if(q == 0) {
                    $el.outerHTML = '';
                }
            });
        }
    }"
    x-init="
        $watch('quantity', () => { 
            if(quantity == '' || quantity < 1) {
                quantity = 1;
            }else {
                changeQuantity($dispatch);
            } 
        });
        
    "
    class="relative flex flex-wrap mx-4 border-t border-gray-200 sm:table-row"
>
    <td class="hidden w-24 py-2 pl-8 sm:block">
        <img src="{{ $item['thumbnail'] }}" class="object-cover rounded-lg h-14 w-14">
    </td> 
    <td class="w-full px-4 pt-2 text-base sm:font-medium">{{ $item['name'] }}</td> 
    <td class="hidden px-4 text-right sm:table-cell whitespace-nowrap">
        {{ $item['price'] }} Kč <span class="sm:hidden">Celkem: <span x-text="{{ $item['price'] }} * quantity">{{ $item['total'] }}</span> Kč</span>
    </td> 
    <td class="px-4 pt-1 pb-2 sm:pt-3">
        <div class="inline-flex items-center space-x-3">
            <svg 
                @click="if(quantity > 1)quantity--"
                :class="{ 'text-gray-400 hover:text-black cursor-pointer': quantity != 1, 'text-gray-200': quantity == 1 }"
                class="" fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
            >
                <path d="M0 10h24v4h-24z"/>
            </svg>
            <input type="text" min="1" x-model.lazy="quantity" class="inline-block w-10 py-0.5 sm:py-1 text-center bg-transparent border-2 border-gray-300 rounded focus:border-gray-900 focus:outline-none"> 
            <svg @click="quantity++" class="text-gray-400 cursor-pointer hover:text-black" fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                <path d="M24 10h-10v-10h-4v10h-10v4h10v10h4v-10h10z"/>
            </svg>
        </div>
    </td>  
    <td class="flex items-center justify-end flex-grow px-4 text-sm font-light sm:font-normal sm:text-sm sm:table-cell whitespace-nowrap">
        <span x-text="{{ $item['price'] }} * quantity">{{ $item['total'] }}</span> Kč
    </td> 
    <td @click="changeQuantity($dispatch, 0)" class="absolute right-0 pr-4 top-2 sm:top-0 sm:relative">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400 cursor-pointer hover:text-red-500">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </td>
</tr>