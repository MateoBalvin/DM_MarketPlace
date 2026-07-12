<div>
    <div class="bg-white w-full rounded-lg shadow-lg flex flex-col max-h-[90vh]">
        <div
            class="py-4 px-6 flex justify-between items-center bg-white sticky top-0 z-10 border-b border-gray-200 pb-2">
            <h1 class="text-lg font-bold text-secondary dark:text-white">Añadir nueva venta</h1>
            <button type="button" x-on:click="$dispatch('close-modal', 'sale-detail-modal')"
                class="cursor-pointer text-gray-500 hover:text-gray-700 hover:animate-spin">
                <flux:icon.x-mark />
            </button>
        </div>

        <div class="p-5 overflow-y-auto flex-1 space-y-3" style="max-height: calc(90vh - 60px);">
            <div class="grid grid-cols-3 gap-5">
                <div class="col-span-2">
                    <flux:text class="text-secondary font-semibold text-base mb-2">Agregar cliente</flux:text>
                    <div class="space-y-7">
                        <div class="flex items-start justify-between gap-3 border shadow-sm p-4 rounded-lg">
                            <div>
                                <flux:text>Cliente</flux:text>
                                <flux:input type="text" icon="magnifying-glass"
                                    wire:model.live.debounce.300ms="searchCustomer" placeholder="Buscar cliente" />

                                @if ($searchCustomer && $appearCustomer)
                                    @if ($customers)
                                        <div class="mt-2 border rounded-xl bg-white">
                                            @foreach ($customers as $customer)
                                                <flux:button variant="ghost" class="w-full"
                                                    wire:click="selectedCustomer({{ $customer->id }})"
                                                    wire:target="selectedCustomer({{ $customer->id }})">
                                                    {{ $customer->name }}</flux:button>
                                            @endforeach
                                        </div>
                                    @endif
                                @endif
                            </div>

                            <div>
                                <flux:text>Fecha</flux:text>
                                <flux:text>{{ $date }}</flux:text>
                            </div>
                        </div>

                        <div>
                            <flux:text class="text-secondary font-semibold text-base mb-2">Agregar producto</flux:text>
                            <div class="flex items-center justify-between gap-3 border shadow-sm p-4 rounded-lg">
                                <div>
                                    <flux:text>Producto</flux:text>
                                    <flux:input type="text" icon="magnifying-glass"
                                        wire:model.live.debounce.300ms="searchProduct" placeholder="Buscar producto" />

                                    @if ($searchProduct && $appearProduct)
                                        @if ($products)
                                            <div class="mt-2 border rounded-xl bg-white">
                                                @foreach ($products as $product)
                                                    <flux:button variant="ghost" class="w-full"
                                                        wire:click="selectedProduct({{ $product->id }})"
                                                        wire:tarjet="selectedClient({{ $product->id }})">
                                                        {{ $product->name }}</flux:button>
                                                @endforeach
                                            </div>
                                        @endif
                                    @endif
                                </div>

                                <div>
                                    <flux:text>Cantidad</flux:text>
                                    <flux:input type="number" wire:model="form.quantity" />
                                </div>

                                @if ($customerSelected && $productSelected)
                                    <flux:tooltip content="Añadir producto a la venta">
                                        <flux:button variant="primary" icon="plus" class="mt-5 cursor-pointer"
                                            wire:click="addProduct" />
                                    </flux:tooltip>
                                @else
                                    <div>
                                        <flux:button variant="primary" icon="plus" class="mt-5" disabled />
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="mt-5">
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm">
                                    <thead class="bg-[#F1E7DB] text-label">
                                        <tr>
                                            <th class="px-4 py-4 text-left rounded-tl-xl">Producto</th>
                                            <th class="px-4 py-4 text-left">Precio</th>
                                            <th class="px-4 py-4 text-left">Cantidad</th>
                                            <th class="px-4 py-4 text-left">Total</th>
                                            <th class="px-4 py-4 text-center rounded-tr-xl">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-xs bg-white">
                                        @foreach ($salesDetail as $saleDetail)
                                            <tr class="border border-zinc-100 hover:bg-yellow-50 transition">
                                                <td class="px-4 py-3 w-50">
                                                    <div class="flex items-center gap-2 text-label font-bold">
                                                        <flux:icon.shopping-bag class="size-6" />
                                                        <p>{{ $saleDetail->product->name }}</p>
                                                    </div>
                                                </td>

                                                <td class="px-4 py-3 text-label">
                                                    {{ $saleDetail->unit_price }}
                                                </td>

                                                <td class="px-4 py-3 text-label">
                                                    {{ $saleDetail->quantity }}
                                                </td>

                                                <td class="px-4 py-3 text-label">
                                                    {{ $saleDetail->total }}
                                                </td>

                                                <td class="px-4 py-3 text-center">
                                                    <flux:tooltip content="Eliminar">
                                                        <flux:button size="xs" icon="trash"
                                                            class="cursor-pointer !bg-black !text-white" />
                                                    </flux:tooltip>
                                                </td>
                                            </tr>
                                        @endforeach

                                        {{-- <tr>
                                            <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                                <div class="flex flex-col items-center space-y-2">
                                                    <flux:icon.building-storefront class="size-6" />
                                                    <p>No se encontraron ventas registrados</p>
                                                </div>
                                            </td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-span-1 border shadow-md rounded-xl">
                    <div class="bg-primary rounded-t-xl p-4">
                        <flux:text class="text-white text-base font-bold">Resumen de la compra</flux:text>
                    </div>

                    <div class="p-4 space-y-2">
                        <div class="flex items-center gap-1">
                            <flux:icon.archive-box class="size-4 text-label" />
                            <flux:text class="text-label font-semibold">
                                Cantidad de productos:
                                <span class="font-normal">2</span>
                            </flux:text>
                        </div>

                        <div class="flex items-center gap-1">
                            <flux:icon.briefcase class="size-4 text-label" />
                            <flux:text class="text-label font-semibold">
                                Total de unidades:
                                <span class="font-normal">32</span>
                            </flux:text>
                        </div>

                        <div class="flex items-center gap-1">
                            <flux:icon.building-storefront class="size-4 text-label" />
                            <flux:text class="text-label font-semibold">
                                Proveedor:
                                <span class="font-normal">Distribuidora El Balvin</span>
                            </flux:text>
                        </div>
                    </div>

                    <div class="p-4 space-y-1">
                        <div class="flex items-center gap-1">
                            <flux:icon.banknotes class="size-4 text-label" />
                            <flux:text class="text-label font-semibold">
                                Total:
                            </flux:text>
                        </div>
                        <flux:text class="text-2xl font-semibold text-secondary">$50.000</flux:text>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-5 flex justify-end gap-2">
            <flux:button type="button" x-on:click="$dispatch('close-modal', 'sale-detail-modal')" variant="filled"
                class="cursor-pointer">Cancelar</flux:button>

            <flux:button type="button" variant="primary" class="cursor-pointer" wire:click="save">Guardar</flux:button>
        </div>
    </div>
</div>
