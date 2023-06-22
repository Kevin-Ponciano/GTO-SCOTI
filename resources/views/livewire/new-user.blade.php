@php use App\Models\Team; @endphp
<div>
    <!--Header-->
    <div class="flex items-start justify-between px-3 py-2 border-b rounded-t dark:border-gray-600">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            {{__('Cadastrar Empresa')}}
        </h3>
    </div>
    <!--Body-->
    <div class="p-4 space-y-6">
        <div class="flex justify-center">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <x-flowbite-label value="Nome"/>
                    <x-flowbite-input wire:model.defer="name" type="text"/>
                    @error('name') <span
                        class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-flowbite-label for="email" value="E-mail"/>
                    <x-flowbite-input wire:model.defer="email" type="text"/>
                    @error('email') <span
                        class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                </div>
{{--                <div>--}}
{{--                    <x-flowbite-label value="Telefone"/>--}}
{{--                    @error('phone') <span--}}
{{--                        class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror--}}
{{--                    <x-flowbite-input type="text"/>--}}
{{--                </div>--}}
                <div>
                    <x-flowbite-label value="Empresa"/>
                    <select
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        wire:model.defer="enterpriseId">
                        <option value="0" disabled>Selecione a Empresa</option>
                        @foreach(Team::all() as $enterprise)
                            <option value="{{$enterprise->id}}">{{$enterprise->name}}</option>
                        @endforeach
                    </select>
                    @error('enterpriseId') <span
                        class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-flowbite-label value="Tipo de usuário"/>
                    <select
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        wire:model.defer="role">
                        @foreach($roles as $role)
                            <option value="{{$role->key}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <x-flowbite-label value="Senha"/>
                    <x-flowbite-input wire:model.defer="password" type="password"/>
                    @error('password') <span
                        class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="flex items-center py-2 px-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
            <x-button-blue wire:click="create()">
                Cadastrar
            </x-button-blue>
            <x-button-red data-dismiss="modal">
                Cancelar
            </x-button-red>
        </div>
    </div>
    <script>
        window.addEventListener('new-user-toast', event => {
            success_info('{{'\nUsuário cadastrado com sucesso!\n\n'}}')
        })
    </script>
</div>


