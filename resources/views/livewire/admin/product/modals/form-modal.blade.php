<div>
    <div class="bg-white w-full rounded-lg shadow-lg flex flex-col max-h-[90vh]">
        <div
            class="py-4 px-6 flex justify-between items-center bg-white sticky top-0 z-10 border-b border-gray-200 pb-2">
            <h1 class="text-lg font-bold text-primary dark:text-white">Añadir producto</h1>
            <button type="button" x-on:click="$dispatch('close-modal', 'form-modal')"
                class="cursor-pointer text-gray-500 hover:text-gray-700 hover:animate-spin">
                <flux:icon.x-mark />
            </button>
        </div>

        <div class="p-5 overflow-y-auto flex-1 space-y-3" style="max-height: calc(90vh - 60px);">

            <div class="space-y-1">
                <flux:text class="font-semibold text-primary">Nombre</flux:text>
                <flux:input type="text" placeholder="Nombre" wire:model="form.name" />
                <flux:error name="form.name" />
            </div>

            <div class="grid grid-cols-2 gap-5 justify-between mt-3">
                <div class="space-y-1">
                    <flux:text class="font-semibold text-primary">Precio del catalogo</flux:text>
                    <flux:input type="number" placeholder="Catálogo" wire:model="form.priceCatalog" />
                    <flux:error name="form.priceCatalog" />
                </div>

                <div class="space-y-1">
                    <flux:text class="font-semibold text-primary">Precio de venta</flux:text>
                    <flux:input type="number" placeholder="Venta" wire:model="form.priceSale" />
                    <flux:error name="form.priceSale" />
                </div>
            </div>

            <div class="space-y-1">
                <flux:text class="font-semibold text-primary">Estado</flux:text>
                <flux:radio.group wire:model="form.status" variant="cards" class="max-sm:flex-col h-10">
                    <flux:radio value="active" label="Activo" class="cursor-pointer !p-2" />
                    <flux:radio value="inactive" label="Inactivo" class="cursor-pointer !p-2" />
                </flux:radio.group>

                <flux:error name="form.status" />
            </div>
        </div>

        <div class="p-5 flex justify-end gap-2">
            <flux:button type="button" x-on:click="$dispatch('close-modal', 'form-modal')" variant="filled"
                class="cursor-pointer">Cancelar</flux:button>

            <flux:button type="button" variant="primary" class="cursor-pointer" wire:click="save">Guardar</flux:button>
        </div>
    </div>
</div>
