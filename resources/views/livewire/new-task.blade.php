<div>
    <!--Header-->
    <div class="flex items-start justify-between px-3 py-2 border-b rounded-t dark:border-gray-600">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            {{__('New Task')}}
        </h3>
    </div>
    <!--Body-->
    <div class="p-4 space-y-6">
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{__('Title')}}
                </label>
                <input type="text" id="title"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       wire:model.defer="title"
                       placeholder="{{__('Title of Task')}}">
                @error('title')<span class="text-sm text-red">{{$message}}</span>@enderror
            </div>
            <div>
                <label for="priority" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{__('Priority')}}
                </label>
                <select id="priority"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        wire:model.defer="priority">
                    <option class="text-gray-900" value="Baixa">Baixa</option>
                    <option class="text-gray-900" value="Média">Média</option>
                    <option class="text-gray-900" value="Alta">Alta</option>
                </select>
            </div>
            <div>
                <label for="responsible" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{__('Responsible')}}
                </label>
                <select id="responsible"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        wire:model.defer="userId">
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="deadline" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{__('Deadline')}}
                </label>
                <input type="date" id="deadline"
                       class="dateTodayController bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       wire:model.defer="deadline">
                @error('deadline')<span class="text-sm text-red">{{$message}}</span>@enderror
            </div>
            <div class="flex items-center">
                <input id="schedule-task" type="checkbox"
                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                       wire:click="showSchedule()">
                <label for="schedule-task" class="mt-2 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Agendar Tarefa
                </label>
            </div>
            @if($isSchedule)
                <div class="flex items-center">
                    <input id="recorrence" type="checkbox"
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                           wire:click="showRecorrence()">
                    <label for="recorrence" class="mt-2 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        Tarefa Recorrente
                    </label>
                </div>
            @endif
        </div>
        @if($isSchedule)
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <x-flowbite-label value="Data"/>
                    <x-flowbite-input type="date" wire:model.defer="date" class="dateTodayController"/>
                    @error('date')<span class="text-sm text-red">{{$message}}</span>@enderror
                </div>
                <div>
                    <x-flowbite-label value="Hora"/>
                    <x-flowbite-input type="time" wire:model.defer="hour"/>
                    @error('hour')<span class="text-sm text-red">{{$message}}</span>@enderror
                </div>
                @if($isRecorrence)
                    <div>
                        <x-flowbite-label value="Quantas vezes deseja repetir?"/>
                        <x-flowbite-input wire:model.defer="recorrenceCount" class="greaterThanOne"/>
                        @error('recorrenceCount')<span class="text-sm text-red">{{$message}}</span>@enderror
                    </div>
                    <div>
                        <x-flowbite-label value="Com que frequência repetir?"/>
                        <select
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            wire:model.defer="frequency">
                            <option value="day">Diariamente</option>
                            <option value="week">Semanalmente</option>
                            <option value="month">Mensalmente</option>
                            <option value="year">Anualmente</option>
                        </select>
                    </div>
                @endif
            </div>
        @endif
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            {{__('Description')}}
        </label>
        <textarea id="description"
                  class="block mt-0 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="{{__('Write the task description')}}..."
                  wire:model.defer="description"
                  rows="3"></textarea>
    </div>
    <!--Footer-->
    <div class="flex items-center py-2 px-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
        <x-button-dark data-dismiss="modal" wire:click="resetInputFields">{{__('Cancel')}}</x-button-dark>
        <x-button-blue wire:click="store">{{__('Create')}}</x-button-blue>
    </div>
    @if (session()->has('success'))
        <script>
            success_task_info('{{session('success')}}', {{$taskId}})
        </script>
    @endif
    <script>
        $(document).ready(function () {
            let dateTodayController = () => {
                let dtToday = new Date()
                let month = dtToday.getMonth() + 1
                let day = dtToday.getDate()
                let year = dtToday.getFullYear()

                if (month < 10)
                    month = '0' + month.toString();
                if (day < 10)
                    day = '0' + day.toString();

                let maxDate = year + '-' + month + '-' + day;

                $('.dateTodayController').attr('min', maxDate)
            }
            dateTodayController()

            let inputMask = () => {
                $('.greaterThanOne').mask('000')
                let input = $('.greaterThanOne');
                input.on('input', function () {
                    let valor = parseInt(input.val());
                    if (valor < 1) {
                        input.val(1);
                    }
                });
            }
            inputMask()
            window.addEventListener('dateTodayRefresh', event => {
                dateTodayController()
                inputMask()
            })
        });

    </script>
</div>
