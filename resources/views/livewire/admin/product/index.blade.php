<div>
    <div>
        <flux:text class="text-xl font-bold text-secondary">Productos</flux:text>
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Inicio</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="">Productos</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>

    <div class="grid grid-cols-5 gap-5 mt-7">
        <div class="bg-white p-3 rounded-xl">
            <div class="flex items-center gap-3 mb-2">
                <flux:icon.archive-box class="size-5 text-secondary" />
                <flux:text class="text-secondary font-bold text-sm">Productos totales</flux:text>
            </div>

            <flux:text class="text-label text-2xl">{{ $products->count() }}</flux:text>
        </div>

        <div class="bg-white p-3 rounded-xl">
            <div class="flex items-center gap-3 mb-2">
                <flux:icon.banknotes class="size-5 text-secondary" />
                <flux:text class="text-secondary font-bold text-sm">Ganancias totales</flux:text>
            </div>
            <flux:text class="text-label text-2xl">
                {{ number_format($products->sum('sale_price') - $products->sum('catalog_price'), 0, ',', '.') }}
            </flux:text>
        </div>

        <div class="bg-white p-3 rounded-xl">
            <div class="flex items-center gap-3 mb-2">
                <flux:icon.users class="size-5 text-secondary" />
                <flux:text class="text-secondary font-bold text-sm">Proveedores activos</flux:text>
            </div>
            <flux:text class="text-label text-2xl">{{ $products->unique('provider_id')->count() }}</flux:text>
        </div>

        <div class="bg-white p-3 rounded-xl">
            <div class="flex items-center gap-3 mb-2">
                <flux:icon.archive-box-arrow-down class="size-5 text-secondary" />
                <flux:text class="text-secondary font-bold text-sm">Productos activos</flux:text>
            </div>
            <flux:text class="text-label text-2xl">
                {{ $products->where('status', 'active')->count() }}
            </flux:text>
        </div>

        <div class="bg-white p-3 rounded-xl">
            <div class="flex items-center gap-3 mb-2">
                <flux:icon.archive-box-x-mark class="size-5 text-secondary" />
                <flux:text class="text-secondary font-bold text-sm">Productos inactivos</flux:text>
            </div>
            <flux:text class="text-label text-2xl">
                {{ $products->where('status', 'inactive')->count() }}
            </flux:text>
        </div>
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
                    <flux:select.option value="active">Activo</flux:select.option>
                    <flux:select.option value="inactive">Inactivo</flux:select.option>
                </flux:select>

                <flux:select wire:model.live="filterProvider">
                    <flux:select.option value="">Todos los provedores</flux:select.option>
                    @foreach ($providers as $provider)
                        <flux:select.option value="{{ $provider->id }}">{{ $provider->name }}</flux:select.option>
                    @endforeach
                </flux:select>
            </div>

            <div>
                <flux:button variant="primary" icon="user-plus" class="cursor-pointer" wire:click="formModal">Añadir
                    Producto</flux:button>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="px-4 py-4 text-left rounded-tl-xl">Nombre</th>
                        <th class="px-4 py-4 text-left">Proveedor</th>
                        <th class="px-4 py-4 text-left">Precio del catalogo</th>
                        <th class="px-4 py-4 text-left">Precio de venta</th>
                        <th class="px-4 py-4 text-left">Ganancia</th>
                        <th class="px-4 py-4 text-left">Estado</th>
                        <th class="px-4 py-4 text-center rounded-tr-xl">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-xs bg-white">
                    @forelse ($products as $product)
                        <tr class="border border-zinc-100 hover:bg-yellow-50 transition">
                            <td class="px-4 py-3 w-30">
                                <div class="flex items-center gap-2 text-secondary font-bold">
                                    <flux:icon.archive-box />

                                    <div>
                                        <p>{{ $product->name ?? 'Sin nombre' }}</p>
                                        <p class="w-40 text-label font-normal truncate">
                                            {{ $product->description ?? 'Sin descripción' }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-3 text-label">
                                {{ $product->provider->name ?? 'Sin proveedor' }}
                            </td>

                            <td class="px-4 py-3 text-label">
                                $ {{ number_format($product->catalog_price, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 text-secondary font-semibold">
                                $ {{ number_format($product->sale_price, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 text-secondary font-bold">
                                $ {{ number_format($product->sale_price - $product->catalog_price, 0, ',', '.') }}

                            <td class="px-4 py-3">
                                @if ($product->status == 'active')
                                    <div
                                        class="text-center p-1 rounded-lg border border-secondary text-secondary bg-secondary/10 font-semibold w-15">
                                        Activo
                                    </div>
                                @else
                                    <div
                                        class="text-center p-1 rounded-lg border border-black text-black bg-[#dfdfdf] font-semibold w-15">
                                        Inactivo
                                    </div>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-center">
                                <flux:tooltip content="Editar">
                                    <flux:button variant="primary" size="xs" icon="pencil" class="cursor-pointer"
                                        wire:click="editModal({{ $product->id }})"
                                        wire:target="editModal({{ $product->id }})" />
                                </flux:tooltip>

                                <flux:tooltip content="Eliminar">
                                    <flux:button size="xs" icon="trash"
                                        class="cursor-pointer !bg-black !text-white"
                                        wire:click="deleteModal({{ $product->id }})"
                                        wire:target="deleteModal({{ $product->id }})" />
                                </flux:tooltip>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center space-y-2">
                                    <flux:icon.inbox-stack class="size-6" />
                                    <p>No se encontraron productos registrados</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="">
        <flux:pagination :paginator="$products" />
    </div>

    <x-modal name="form-modal" max-width="xl">
        <livewire:admin.product.modals.form-modal />
    </x-modal>

    <x-modal name="delete-modal" max-width="md">
        <livewire:admin.product.modals.delete-modal />
    </x-modal>
</div>
