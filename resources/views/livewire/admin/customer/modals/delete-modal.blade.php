<div class="p-6">
    <div class="flex items-center gap-3">
        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-100">
            <flux:icon.trash class="h-6 w-6 text-black"/>
        </div>

        <div>
            <flux:text class="text-lg font-bold text-black">
                Eliminar proveedor
            </flux:text>

            <flux:text class="mt-1 text-gray-500">
                Esta acción eliminará el proveedor y no podrá recuperarse.
            </flux:text>
        </div>
    </div>

    <div class="mt-6 rounded-lg border border-gray-300 bg-gray-50 p-4">
        <flux:text class="text-black font-bold">
            Proveedor: 
            <span class="font-normal">{{$customer?->name}}</span> 
        </flux:text>

        <flux:text class="text-gray-500 mt-1">
            ¿Estás seguro de que deseas continuar?
        </flux:text>
    </div>

    <div class="mt-8 flex justify-end gap-3">
        <flux:button variant="ghost" x-on:click="$dispatch('close-modal','delete-modal')" class="cursor-pointer">
            Cancelar
        </flux:button>

        <flux:button wire:click="delete" class="!bg-black !text-white cursor-pointer">
            Eliminar
        </flux:button>
    </div>
</div>
