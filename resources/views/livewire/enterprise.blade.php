@php
    use App\Http\Livewire\Enterprise;
    $sortDirectionIcon = $sortDirection == 'asc' ? 'up' : 'down'
@endphp
<div>
    <div class="space-y-2">
        <div class="flex items-center justify-between px-4 py-3">
            <label for="search" class="sr-only">Search</label>
            <div class="relative w-48">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                              clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="search"
                       class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="{{__('Pesquisar')}}..."
                       wire:model="search">
            </div>
            <x-button-blue onclick="$('#new-enterprise-modal').modal('show')">
                 <i class="nav-icon bi bi-building-fill-add"></i>
                Cadastrar Empresa
            </x-button-blue>
        </div>
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg"
             style="border-radius: 0.9rem;">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 hover:underline" wire:click="sortBy('name')">
                        {{__('Name')}}
                        <i class="pl-2 bi bi-chevron-{{$sortField === 'name' ? $sortDirectionIcon : null}}"></i>
                    </th>
                    <th scope="col" class="px-6 py-3 hover:underline" wire:click="sortBy('cnpj')">
                        {{__('CNPJ')}}
                        <i class="pl-2 bi bi-chevron-{{$sortField === 'cnpj' ? $sortDirectionIcon : null}}"></i>
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                </tr>
                </thead>
                <tbody wire:loading.class="opacity-50">
                @forelse($enterprises as $enterprise)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="flex items-center w-80 px-6 py-2 text-gray-900 whitespace-nowrap dark:text-white">
                            {{$enterprise->name}}
                        </th>

                        <td class="py-2 w-48 px-6">
                            {{$enterprise->cnpj}}
                        </td>
                        <td class="flex items-end justify-end py-2 space-x-3">
                            <a href="{{route('teams.show', $enterprise->id)}}"
                               class="text-white text-xs bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-100 dark:focus:ring-blue-400 rounded-lg px-3 py-2 mr-2 mb-2">
                                Editar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white">
                        <td colspan="6">
                            <div class="flex justify-center items-center">
                                <span class="font-medium py-6 text-gray-400 text-lg">
                                    {{__('Empresa não encontrada...')}}
                                </span>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <!--Modal-->
        <div class="modal fade" id='new-enterprise-modal' tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
             aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content mb-3" style="border-radius: .5rem;">
                    <livewire:new-enterprise/>
                </div>
            </div>
        </div>
        <!--Fim Modal-->
        <div>
            {{$enterprises->links()}}
        </div>
    </div>
</div>

