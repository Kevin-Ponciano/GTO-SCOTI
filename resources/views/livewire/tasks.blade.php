@php
    use app\http\Livewire\Tasks;
    use Carbon\Carbon;
    use App\Models\User;

    $sortDirectionIcon = $sortDirection == 'asc' ? 'up' : 'down'
@endphp
<div>
    <div class="space-y-2">
        <div class="flex items-center justify-between px-4 py-3">
            <div class="flex justify-between">
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
                           placeholder="{{__('Search tasks')}}..."
                           wire:model="search">
                </div>
                <button type="button"
                        onclick="$('#apply-filter').modal('show')"
                        class="bg-blue-400 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none hover:bg-gray-600 m-2 px-2 py-1 rounded-full text-center text-white text-xs">
                    {{__('Apply Filter')}}
                </button>
            </div>


            {{--            <h1 class="text-xl font-bold tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">{{__('Tasks')}}</h1>--}}

            <button
                class="bg-gradient-to-br  dark:text-white focus:outline-none font-medium from-cyan-500 group group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white inline-flex items-center justify-center overflow-hidden p-0.5 relative rounded-lg text-gray-600 text-sm to-blue-500">
                  <span
                      class="bg-gray-100 dark:bg-gray-900 duration-75 ease-in font-black group-hover:bg-opacity-0 px-4 py-1 relative rounded-md transition-all"
                      onclick="$('#new_task_modal').modal('show')">
                      {{__('New Task')}}
                  </span>
            </button>
        </div>

        <div class="overflow-x-auto relative shadow-md sm:rounded-lg"
             style="border-radius: 0.9rem;">
            <table class="w-full text-md text-center text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left hover:underline" wire:click="sortBy('title')">
                        {{__('Title')}}
                        <i class="pl-2 bi bi-chevron-{{$sortField === 'title' ? $sortDirectionIcon : null}}"></i>
                    </th>
                    <th scope="col" class="px-6 py-3 hover:underline" wire:click="sortBy('priority')">
                        {{__('Priority')}}
                        <i class="pl-2 bi bi-chevron-{{$sortField === 'priority' ? $sortDirectionIcon : null}}"></i>
                    </th>
                    <th scope="col" class="px-6 py-3 hover:underline" wire:click="sortBy('deadline')">
                        {{__('Deadline')}}
                        <i class="pl-2 bi bi-chevron-{{$sortField === 'deadline' ? $sortDirectionIcon : null}}"></i>
                    </th>
                    <th scope="col" class="px-6 py-3 hover:underline" wire:click="sortBy('status')">
                        {{__('Status')}}
                        <i class="pl-2 bi bi-chevron-{{$sortField === 'status' ? $sortDirectionIcon : null}}"></i>
                    </th>
                    <th scope="col" class="px-6 py-3 hover:underline" wire:click="sortBy('user_id')">
                        {{__('Responsible')}}
                        <i class="pl-2 bi bi-chevron-{{$sortField === 'user_id' ? $sortDirectionIcon : null}}"></i>
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                </tr>
                </thead>
                <tbody wire:loading.class="opacity-50">
                @forelse($tasks as $task)
                    @php
                        if($task->status == 'Em dia')
                            $status_color = 'success';
                        elseif ($task->status == 'Expirado' || $task->status == 'Finalizada')
                            $status_color = 'danger';
                        else
                            $status_color = 'warning';
                        $task->deadline = Carbon::createFromFormat("Y-m-d", $task['deadline'])->format("d/m/Y");
                    @endphp
                        <tr onclick="location.href='{{route('task_detail',$task->id)}}'"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer">
                        <th scope="row"
                            class="text-muted text-left px-6 text-gray-900 whitespace-nowrap dark:text-white">
                            {{$task->title}}
                        </th>
                        <td class="px-6">
                            {{$task->priority}}
                        </td>
                        <td class="px-6">
                            {{$task->deadline}}
                        </td>
                        <td class="px-6 ">
                            <span class="badge badge-{{$status_color}}">
                                {{$task->status}}</span>
                        </td>
                        <td class="px-6">
                            {{Tasks::getTaskCreator($task->user_id)}}
                        </td>
                        <td class="items-end px-6 py-2 space-x-3">
                            <a href="{{route('task_detail',$task->id)}}">
                                <x-button-blue class="!py-2 !px-4 !text-sm">
                                    {{__('Detail')}}
                                </x-button-blue>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white">
                        <td colspan="6">
                            <div class="flex justify-center items-center">
                                <span class="font-medium py-6 text-gray-400 text-lg">
                                    {{__('No Task Found...')}}
                                </span>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div>
            {{$tasks->links()}}
        </div>
    </div>

    <div class="modal fade" id="apply-filter" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!--Body-->
                <div class="p-2.5 space-y-6">
                    <div class="grid gap-6 md:grid-cols-3 text-md">
                        <div>
                            <label for="userFilter"
                                   class="block mb-2 font-medium text-gray-900 dark:text-white">
                                {{__('Responsible')}}
                            </label>
                            <select id="userFilter"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    wire:model.defer="userFilter">
                                <option value="">{{__('No filter')}}</option>
                                @foreach(User::where('current_team_id',Auth::user()->current_team_id)->get() as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="priorityFilter"
                                   class="block mb-2 font-medium text-gray-900 dark:text-white">
                                {{__('Priority')}}
                            </label>
                            <select id="priorityFilter"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    wire:model.defer="priorityFilter">
                                <option value="">{{__('No filter')}}</option>
                                <option value="Baixa">Baixa</option>
                                <option value="Média">Média</option>
                                <option value="Alta">Alta</option>
                            </select>
                        </div>
                        <div>
                            <label for="statusFilter"
                                   class="block mb-2 font-medium text-gray-900 dark:text-white">
                                {{__('Status')}}
                            </label>
                            <select id="statusFilter"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    wire:model.defer="statusFilter">
                                <option class="text-muted" value="">{{__('No filter')}}</option>
                                <option value="Em dia">Em dia</option>
                                <option value="dias para expirar">Proximo</option>
                                <option value="Expirado">Expirado</option>
                                <option value="Finalizadas">Finalizadas</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!--Footer-->
                <div
                    class="flex items-center justify-between py-1 px-6 space-x-2 rounded-b dark:border-gray-600">
                    <x-button-red class="py-2.5" data-dismiss="modal"
                                  wire:click="resetFilter">{{__('Reset filters')}}</x-button-red>
                    <x-button-blue data-dismiss="modal" wire:click="applyFilter"> {{__('Apply')}}</x-button-blue>
                </div>
            </div>
        </div>
    </div>
</div>
