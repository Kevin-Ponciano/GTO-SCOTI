<div
    class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 modal-content"
    style="border-color: transparent;">
    <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
        <label for="comment" class="sr-only">Your comment</label>
        <textarea id="comment" rows="4"
                  class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                  placeholder="{{__('Write a comment')}}..."
                  wire:model.defer="comment"></textarea>
    </div>
    <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
        <x-button-blue wire:click="store">
            {{__('Create')}}
        </x-button-blue>
        {{--        <x-button-dark--}}
        {{--            data-dismiss="modal"--}}
        {{--            wire:click="resetInputFields">--}}
        {{--            {{__('Cancel') }}--}}
        {{--        </x-button-dark>--}}
        <div class="flex pl-0 space-x-1 sm:pl-2">
            <label class="relative inline-flex items-center mb-1 cursor-pointer">
                <input type="checkbox" value="" class="sr-only peer" wire:model="private"
                       wire:click="label_private">
                <div
                    class="w-11 h-6 bg-green-400 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                <span class="ml-3 text-sm font-semibold text-gray-900 dark:text-gray-300">{{$isPrivate}}</span>
            </label>
        </div>
    </div>
    @if (session()->has('success'))
        <script>
            success_info('{{session('success')}}')
        </script>
    @endif
</div>


