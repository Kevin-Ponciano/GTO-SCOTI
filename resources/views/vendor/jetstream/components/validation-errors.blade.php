@if ($errors->any())
    <div {{ $attributes }}>
        <div class="flex p-2 mb-3 text-xs text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
             role="alert">
            <span class="sr-only">Danger</span>
            <div>
                <ul class="ml-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
@endif
