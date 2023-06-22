<div>
    <!--Header-->
    <div class="flex items-start justify-between px-3 py-2 border-b rounded-t dark:border-gray-600">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            {{__('Cadastrar Empresa')}}
        </h3>
    </div>
    <!--Body-->
    <div class="p-4 space-y-6">
        <div class="grid gap-6 mb-6 md:grid-cols-1">
            <div>
                <x-flowbite-label value="Nome"/>
                <x-flowbite-input wire:model.defer="name" type="text"/>
                @error('name') <span
                    class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-flowbite-label value="CNPJ"/>
                <x-flowbite-input wire:model.defer="cnpj" type="text"/>
                @error('cnpj') <span
                    class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
            </div>
        </div>
        <x-button-blue wire:click="create()">
            Cadastrar
        </x-button-blue>
        <x-button-red data-dismiss="modal">
            Cancelar
        </x-button-red>
    </div>
    <script>
        window.addEventListener('new-enterprise-toast', event => {
            success_info('{{'\nEmpresa cadastrada com sucesso!\n\n'}}')
        })
    </script>
</div>
