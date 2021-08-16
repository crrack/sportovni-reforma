<div class="mb-4">
    <div class="py-2 pl-4">
        Osobní údaje
    </div> 
    <div class="flex flex-col px-8 py-6 bg-white md:px-4">
        <div class="grid grid-cols-12 gap-4">
            <x-order-input size="7" name="email" placeholder="Email *"/>
            <x-order-input size="5" name="telephone" placeholder="Telefon *"/>
        </div>
    </div>
</div>

<div class="mb-4">
    <div class="py-2 pl-4">
        Fakturační adresa
    </div> 
    <div class="flex flex-col px-8 py-6 bg-white md:px-4">
        <div class="grid grid-cols-12 gap-4">
            <x-order-input size="6" name="order_name" placeholder="Jméno *"/>
            <x-order-input size="6" name="order_surname" placeholder="Příjmení *"/>
            <x-order-input size="9" name="order_street" placeholder="Ulice *" tracking="true"/>
            <x-order-input size="3" name="order_number" placeholder="Číslo domu *"/>
            <x-order-input size="8" name="order_city" placeholder="Město *" tracking="true"/>
            <x-order-input size="4" name="order_post_code" placeholder="PSČ *" tracking="true"/>
            <div class="col-span-12">
                <select class="w-full px-3 py-2 border-2 rounded focus:border-gray-900 focus:outline-none">
                    <option value="czech">Česká republika</option>
                    <option value="slovak">Slovensko</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="flex flex-col px-8 py-2 mb-4 bg-white md:px-6">
    <x-checkbox click="note = !note" condition="note">Přidat poznámku</x-checkbox>
    <div x-show="note" class="mt-2 mb-4">
        <textarea x-model="form.note" placeholder="Poznámka" class="border-2 rounded px-3 py-1.5 w-full focus:border-gray-900 focus:outline-none placeholder"></textarea>
    </div>
    <x-checkbox click="deliveryAddress = !deliveryAddress" condition="deliveryAddress">Jiná doručovací adresa</x-checkbox>
    {{-- <x-checkbox click="form.accept_terms = !form.accept_terms" condition="form.accept_terms">
        Souhlasím s 
        <a href="/stranka/obchodni-podminky" class="text-red-600 hover:text-red-700">obchodními podmínkami</a> a 
        <a href="/stranka/ochrana-osobnich-udaju" class="text-red-600 hover:text-red-700">ochranou osobních údajů</a>.
    </x-checkbox> --}}
</div>

<div x-show="deliveryAddress" class="mb-4">
    <div class="py-2 pl-4">
        Doručovací adresa
    </div> 
    <div class="flex flex-col px-8 py-6 bg-white md:px-4">
        <div class="grid grid-cols-12 gap-4">
            <x-order-input size="6" name="delivery_name" placeholder="Jméno *" tracking="true"/>
            <x-order-input size="6" name="delivery_surname" placeholder="Příjmení *"/>
            <x-order-input size="9" name="delivery_street" placeholder="Ulice *" tracking="true"/>
            <x-order-input size="3" name="delivery_number" placeholder="Číslo domu *"/>
            <x-order-input size="8" name="delivery_city" placeholder="Město *" tracking="true"/>
            <x-order-input size="4" name="delivery_post_code" placeholder="PSČ *" tracking="true"/>
            <div class="col-span-12">
                <select class="w-full px-3 py-2 border-2 rounded focus:border-gray-900 focus:outline-none">
                    <option value="czech">Česká republika</option>
                    <option value="slovak">Slovensko</option>
                </select>
            </div>
        </div>
    </div>
</div>