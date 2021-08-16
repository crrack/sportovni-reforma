<table class="block w-full mt-1 mb-8 text-sm table-auto sm:table">
    <thead class="block sm:table-header-group">
        <tr class="flex font-semibold bg-secondary sm:table-row">
            <td class="hidden w-20 sm:table-cell"></td>
            <td class="px-4 py-2 opacity-50">Název</td> 
            <td class="hidden px-4 py-2 text-right opacity-50 whitespace-nowrap sm:block">Cena</td> 
            <td class="px-4 py-2 text-center opacity-50">Počet kusů</td> 
            <td class="hidden px-4 py-2 opacity-50 whitespace-nowrap sm:block">Součet</td> 
            <td></td>
        </tr>
    </thead> 
    <tbody class="block bg-white sm:table-row-group first-border-0">
        @foreach ($cart['items'] as $item)
            <x-cart-item :item="$item"/>
        @endforeach
    </tbody>
</table> 
<div class="flex flex-col w-full sm:flex-row sm:space-x-6">
    <div class="mb-4 sm:w-3/5">
        <div class="py-2 pl-4">
            Způsob doručení
        </div> 
        <div class="flex flex-col py-2 bg-white">
            @foreach ($cart['shipments'] as $shipment)
                @if($shipment['name'] == 'zasilkovna')
                    <x-radio 
                        onclick="Packeta.Widget.pick(packetaApiKey, showSelectedPickupPoint, { language: 'cs' })"
                        click="shipment_price = {{ $shipment['price'] }}, form.shipment_id = {{ $shipment['id'] }}" 
                        condition="form.shipment_id == {{ $shipment['id'] }}" 
                        right="+{{ $shipment['price'] }}Kč"
                    >
                        {{ $shipment['title'] }} <br>
                        <button 
                            x-show="form.shipment_id == {{ $shipment['id'] }}" 
                            type="button" 
                            class="max-w-xs text-sm font-medium text-red-500 truncate hover:text-red-600"
                        >
                            <span id="packeta-point-info">Vybrat pobočku</span>
                        </button>
                    </x-radio>
                @else
                    <x-radio 
                        click="shipment_price = {{ $shipment['price'] }}, form.shipment_id = {{ $shipment['id'] }}" 
                        condition="form.shipment_id == {{ $shipment['id'] }}" 
                        right="+{{ $shipment['price'] }}Kč"
                    >
                        {{ $shipment['title'] }}
                    </x-radio>
                @endif
            @endforeach
        </div>
    </div> 
    <div class="mb-4 sm:w-2/5">
        <div class="py-2 pl-4">
            Způsob platby
        </div> 
        <div class="flex flex-col py-2 bg-white">
            @foreach ($cart['payments'] as $payment)
                <x-radio 
                    click="payment_price = {{ $payment['price'] }}, form.payment_id = {{ $payment['id'] }}" 
                    condition="form.payment_id == {{ $payment['id'] }}" 
                    right="+{{ $payment['price'] }}Kč"
                >
                    {{ $payment['title'] }}
                </x-radio>
            @endforeach
        </div>
    </div>
</div> 