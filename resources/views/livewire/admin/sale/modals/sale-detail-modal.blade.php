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
                <div class="col-span-2 space-y-7">
                    <div class="flex items-center justify-between gap-3 border shadow-sm p-4 rounded-lg">
                        <div>
                            <flux:text>Cliente</flux:text>
                            <flux:input type="text" wire:model="" />
                        </div>

                        <div>
                            <flux:text>Fecha</flux:text>
                            <flux:input type="date" wire:model="" />
                        </div>
                    </div>

                    <div class="mt-4 flex items-center justify-between gap-3 border shadow-sm p-4 rounded-lg">
                        <div>
                            <flux:text>Producto</flux:text>
                            <flux:input type="text" wire:model="" />
                        </div>

                        <div>
                            <flux:text>Cantidad</flux:text>
                            <flux:input type="number" wire:model="" />
                        </div>

                        <flux:tooltip content="Añadir producto a la venta">
                            <flux:button variant="primary" icon="plus" class="mt-5 cursor-po8|" />
                        </flux:tooltip>
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
                                    <tr class="border border-zinc-100 hover:bg-yellow-50 transition">
                                        <td class="px-4 py-3 w-50">
                                            <div class="flex items-center gap-2 text-label font-bold">
                                                <flux:icon.shopping-bag class="size-6" />
                                                <p>Nombre de producto</p>
                                            </div>
                                        </td>

                                        <td class="px-4 py-3 text-label">
                                            Precio
                                        </td>

                                        <td class="px-4 py-3 text-label">
                                            Cantidad
                                        </td>

                                        <td class="px-4 py-3 text-label">
                                            Total
                                        </td>

                                        <td class="px-4 py-3 text-center">
                                            <flux:tooltip content="Eliminar">
                                                <flux:button size="xs" icon="trash"
                                                    class="cursor-pointer !bg-black !text-white" />
                                            </flux:tooltip>
                                        </td>
                                    </tr>

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

                <div class="col-span-1 border shadow-md rounded-xl">
                    <div class="bg-primary rounded-t-xl p-4">
                        <flux:text class="text-white text-base font-bold">Resumen de la compra</flux:text>
                    </div>

                    <div class="p-4 space-y-2">
                        <flux:text class="text-label">
                            Cantidad de productos:
                            <span>2</span>
                        </flux:text>

                        <flux:text class="text-label">
                            Valor unitario:
                            <span>$50.000</span>
                        </flux:text>
                    </div>

                    <div class="p-4 space-y-1">
                        <flux:text class="text-label">Total</flux:text>
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
