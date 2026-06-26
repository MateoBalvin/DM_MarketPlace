<div>
    <div>
        <flux:text class="text-xl font-bold text-primary">Productos</flux:text>
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Inicio</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="">Productos</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>

    <div class="mt-5">
        <div class="flex justify-between mt-2 mb-5">
            <flux:input wire:model.live="search" placeholder="Buscar" icon="magnifying-glass" class="max-w-50" clearable />

            <div>
                <flux:button variant="primary" icon="user-plus" class="cursor-pointer" wire:click="formModal">Añadir
                    Producto</flux:button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="px-4 py-2 text-left rounded-tl-xl">Nombre</th>
                        <th class="px-4 py-2 text-left">Precio del catalogo</th>
                        <th class="px-4 py-2 text-left">Precio de venta</th>
                        {{-- <th class="px-4 py-2 text-left">Stock</th> --}}
                        <th class="px-4 py-2 text-left">Estado</th>
                        <th class="px-4 py-2 text-left rounded-tr-xl">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-xs bg-white">
                    @forelse ($products as $product)
                        <tr class="border border-zinc-100 hover:bg-green-50 transition">
                            <td class="px-4 py-3 w-50">
                                {{ $product->name ?? 'Sin nombre' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $product->catalog_price ?? 'Sin precio de catalogo' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $product->sale_price ?? 'Sin precio de venta' }}
                            </td>

                            {{-- <td class="px-4 py-3">
                                {{ $product->stock ?? 'Sin stock' }}
                            </td> --}}

                            <td class="px-4 py-3">
                                @if ($product->status == 'active')
                                    <flux:badge size="sm" color="lime">Activo</flux:badge>
                                @else
                                    <flux:badge size="sm" color="red">Inactivo</flux:badge>
                                @endif
                            </td>

                            <td class="px-4 py-3 ">
                                <flux:tooltip content="Editar">
                                    <flux:button variant="primary" size="xs" icon="pencil" class="cursor-pointer"
                                        wire:click="editModal({{ $product->id }})"
                                        wire:target="editModal({{ $product->id }})" />
                                </flux:tooltip>

                                <flux:tooltip content="Eliminar">
                                    <flux:button variant="danger" size="xs" icon="trash" class="cursor-pointer"
                                        wire:click="deleteModal({{ $product->id }})"
                                        wire:target="deleteModal({{ $product->id }})" />
                                </flux:tooltip>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center space-y-2">
                                    <flux:icon.inbox-stack class="size-6" />
                                    <p >No se encontraron productos registrados</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="">
        {{-- <flux:pagination :paginator="$participants" /> --}}
    </div>

    <x-modal name="form-modal" max-width="xl">
        <livewire:admin.product.modals.form-modal />
    </x-modal>

    <x-modal name="delete-modal" max-width="md">
        <livewire:admin.product.modals.delete-modal />
    </x-modal> 
</div>
