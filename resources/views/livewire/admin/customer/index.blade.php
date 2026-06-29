<div>
    <div>
        <flux:text class="text-xl font-bold text-secondary">Clientes</flux:text>
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Inicio</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="">Proveedores</flux:breadcrumbs.item>
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
                    <flux:select.option value="active">Activo</flux:select.option>
                    <flux:select.option value="inactive">Inactivo</flux:select.option>
                </flux:select>
            </div>

            <div>
                <flux:button variant="primary" icon="user-plus" class="cursor-pointer" wire:click="formModal">Añadir
                    cliente</flux:button>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="px-4 py-4 text-left rounded-tl-xl">Nombre</th>
                        <th class="px-4 py-4 text-left">Correo</th>
                        <th class="px-4 py-4 text-left">Telefóno</th>
                        <th class="px-4 py-4 text-left">Dirección</th>
                        <th class="px-4 py-4 text-left">Estado</th>
                        <th class="px-4 py-4 text-center rounded-tr-xl">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-xs bg-white">
                    @forelse ($customers as $customer)
                        <tr class="border border-zinc-100 hover:bg-yellow-50 transition">
                            <td class="px-4 py-3 w-50">
                                <div class="flex items-center gap-2 text-secondary font-bold">
                                    <flux:icon.user-circle class="size-6" />
                                    <p>{{ $customer->name ?? 'Sin nombre' }}</p>
                                </div>
                            </td>

                            <td class="px-4 py-3 text-label">
                                {{ $customer->email ?? 'Sin correo' }}
                            </td>

                            <td class="px-4 py-3 text-label">
                                {{$customer->phone ?? 'Sin teléfono'}}
                            </td>

                            <td class="px-4 py-3 text-label">
                                {{$customer->address ?? 'Sin dirección'}}
                            </td>

                            <td class="px-4 py-3">
                                @if ($customer->status == 'active')
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
                                        wire:click="editModal({{ $customer->id }})"
                                        wire:target="editModal({{ $customer->id }})" />
                                </flux:tooltip>

                                <flux:tooltip content="Eliminar">
                                    <flux:button size="xs" icon="trash"
                                        class="cursor-pointer !bg-black !text-white"
                                        wire:click="deleteModal({{ $customer->id }})"
                                        wire:target="deleteModal({{ $customer->id }})" />
                                </flux:tooltip>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center space-y-2 text-sm">
                                    <flux:icon.user-circle class="size-9" />
                                    <p>No se encontraron clientes registrados</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="">
        <flux:pagination :paginator="$customers" />
    </div>

    <x-modal name="form-modal" max-width="xl">
        <livewire:admin.customer.modals.form-modal />
    </x-modal>

    <x-modal name="delete-modal" max-width="md">
        <livewire:admin.customer.modals.delete-modal />
    </x-modal>
</div>
