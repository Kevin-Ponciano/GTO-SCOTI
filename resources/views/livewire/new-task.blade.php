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
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       wire:model.defer="deadline">
                @error('deadline')<span class="text-sm text-red">{{$message}}</span>@enderror
                <script>
                    dateTodayController = () => {
                        let dtToday = new Date()
                        let month = dtToday.getMonth() + 1
                        let day = dtToday.getDate()
                        let year = dtToday.getFullYear()

                        if (month < 10)
                            month = '0' + month.toString();
                        if (day < 10)
                            day = '0' + day.toString();

                        let maxDate = year + '-' + month + '-' + day;

                        $('#deadline').attr('min', maxDate)
                    }
                    dateTodayController()
                    window.addEventListener('dateTodayRefresh', event => {
                        dateTodayController()
                    })
                </script>
            </div>
        </div>
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            {{__('Description')}}
        </label>
        <textarea id="description"
                  class="block mt-0 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="{{__('Write the task description...')}}"
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
</div>
