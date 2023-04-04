@php use App\Models\Team; @endphp
<div>
    <div class="flex justify-center">
        <form class="w-1/2 py-12">
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
                <div>
                    <x-flowbite-label value="Telefone"/>
                    @error('phone') <span
                        class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                    <x-flowbite-input type="text" placeholder="(27) 91234-5678"/>
                </div>
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
                    <x-flowbite-label value="Função"/>
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
                    <x-flowbite-input wire:model.defer="password" type="password" placeholder="********"/>
                    @error('password') <span
                        class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                </div>
            </div>
            <x-button-blue wire:click="create()">
                Cadastrar
            </x-button-blue>
        </form>
    </div>
</div>


