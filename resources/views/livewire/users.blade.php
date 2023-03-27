@php
    use App\Http\Livewire\Users;
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
                       placeholder="{{__('Search users by email')}}..."
                       wire:model="search">
            </div>
            <i class="bi bi-three-dots"></i>
        </div>
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg"
             style="border-radius: 0.9rem;">
            @if (session('status'))
                <div
                    class="flex p-1 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
                    role="alert">
                    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor"
                         viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        {{session('status')}}
                    </div>
                </div>
            @endif
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 hover:underline" wire:click="sortBy('name')">
                        {{__('Name')}}
                        <i class="pl-2 bi bi-chevron-{{$sortField === 'name' ? $sortDirectionIcon : null}}"></i>
                    </th>
                    <th scope="col" class="px-6 py-3 hover:underline" wire:click="sortBy('current_team_id')">
                        {{__('Enterprise')}}
                        <i class="pl-2 bi bi-chevron-{{$sortField === 'current_team_id' ? $sortDirectionIcon : null}}"></i>
                    </th>
                    <th scope="col" class="px-6 py-3 hover:underline" wire:click="sortBy('role')">
                        {{__('Function')}}
                        <i class="pl-2 bi bi-chevron-{{$sortField === 'role' ? $sortDirectionIcon : null}}"></i>
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                </tr>
                </thead>
                <tbody wire:loading.class="opacity-50">
                @forelse($users as $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="flex items-center w-80 px-6 py-2 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-10 h-10 rounded-full" src="{{$user->profile_photo_url}}"
                                 alt="{{$user->name}}">
                            <div class="pl-3">
                                <div class="text-base font-semibold">{{$user->name}}</div>
                                <div class="text-normal text-gray-500">{{$user->email}}</div>
                            </div>
                        </th>

                        <td class="py-2 w-48 px-6">
                            {{Users::get_enterprise($user->allTeams()->jsonSerialize())}}
                        </td>
                        <td class="py-2 w-44 px-6">
                            {{Users::getRole($user->teamRole($user->currentTeam))}}
                        </td>
                        <td class="flex items-end justify-end py-2 space-x-3">
                            @if(Auth::user()->role == 'admin')
                                <button
                                class="text-white text-xs bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 rounded-lg px-3 py-2 mr-2 mb-2"
                                wire:click="$emit('edit',{{$user->id}})"
                                onclick="$('#edit_user_modal').modal('show')">Editar
                            </button>
                            @endif
                            <form method="POST" action="{{ route('redefine-password') }}">
                                @csrf
                                <input value="{{$user->email}}" name="email" hidden>

                                <button type="submit"
                                        class="text-gray-900 text-xs bg-gradient-to-r from-red-200 via-red-300 to-yellow-200 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400 rounded-lg px-3 py-2 mr-2 mb-2">
                                    Redefinir senha
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr class="bg-white">
                        <td colspan="6">
                            <div class="flex justify-center items-center">
                                <span class="font-medium py-6 text-gray-400 text-lg">
                                    {{__('No Users Found...')}}
                                </span>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="modal fade" id='edit_user_modal' tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
             aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content mb-3" style="border-radius: .5rem;">
                    <livewire:edit-user/>
                </div>
            </div>
        </div>
        <div>
            {{$users->links()}}
        </div>
    </div>
</div>

