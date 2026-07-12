<div>
    <div>
        <flux:text class="text-xl font-bold text-secondary">Ventas</flux:text>
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Inicio</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="">Ventas</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>

    <div class="p-3 bg-white rounded-xl mt-7 text-base space-y-2">
        <div class="flex items-center gap-1 text-secondary font-semibold">
            <flux:icon.adjustments-horizontal class="size-5" />
            <p>Filtros</p>
        </div>

        <div class="flex items-center gap-2 justify-between">
            <div class="flex items-center gap-2">
                <flux:input wire:model.live="search" placeholder="Buscar" icon="magnifying-glass" class="max-w-50"
                    clearable />

                <flux:select wire:model.live="filterStatus">
                    <flux:select.option value="">Todos los estados</flux:select.option>
                    <flux:select.option value="active">Completado</flux:select.option>
                    <flux:select.option value="inactive">Pendiente</flux:select.option>
                </flux:select>
            </div>

            <div>
                <flux:button variant="primary" icon="plus" class="cursor-pointer" wire:click="saleDetailModal">Añadir
                    venta</flux:button>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="px-4 py-4 text-left rounded-tl-xl">Cliente</th>
                        <th class="px-4 py-4 text-left">Productos</th>
                        <th class="px-4 py-4 text-left">Total</th>
                        <th class="px-4 py-4 text-left">Fecha</th>
                        <th class="px-4 py-4 text-left">Estado</th>
                        <th class="px-4 py-4 text-center rounded-tr-xl">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-xs bg-white">
                    @forelse ($sales as $sale)
                        <tr class="border border-zinc-100 hover:bg-yellow-50 transition">
                            <td class="px-4 py-3 w-50">
                                <div class="flex items-center gap-2 text-secondary font-bold">
                                    <flux:icon.shopping-bag class="size-6" />
                                    <p>{{ $sale->customer->name ?? 'Sin nombre' }}</p>
                                </div>
                            </td>

                            <td class="px-4 py-3 text-label">
                                Productos
                            </td>

                            <td class="px-4 py-3 text-label">
                                {{ $sale->total ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-label">
                                {{ $sale->sold_at ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                @if ($sale->status == 'pending')
                                    <div
                                        class="text-center p-1 rounded-lg border border-secondary text-secondary bg-secondary/10 font-semibold w-20">
                                        Pendiente
                                    </div>
                                @else
                                    <div
                                        class="text-center p-1 rounded-lg border border-black text-black bg-[#dfdfdf] font-semibold w-20">
                                        Completado
                                    </div>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-center">
                                <flux:tooltip content="Ver">
                                    <flux:button variant="primary" size="xs" icon="eye"
                                        class="cursor-pointer" />
                                </flux:tooltip>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center space-y-2">
                                    <flux:icon.building-storefront class="size-6" />
                                    <p>No se encontraron ventas registrados</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <flux:pagination :paginator="$sales" />
    </div>

    <x-modal name="sale-detail-modal" max-width="4xl">
        <livewire:admin.sale.modals.sale-detail-modal />
    </x-modal>
</div>
