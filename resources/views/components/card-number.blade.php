
<div
    class="text-center {{$color}} ml-11 mt-3 w-64 max-w-sm p-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <a class="mb-3 p-2 text-8xl text-gray-900 tracking-tight dark:text-white">
        {{$number}}
    </a>
    <div class="pt-2 mt-2 border-t border-gray-200 dark:border-gray-700"></div>
    <a href="{{$url}}"
       class="inline-flex items-center px-3 text-lg font-medium text-center dark:text-white">
        <i class="{{$icon}} px-2"></i>
        {{$info}}
    </a>
</div>
