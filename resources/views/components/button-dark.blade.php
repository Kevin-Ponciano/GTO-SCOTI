<button {{ $attributes->merge(['type' => 'button', 'class' => 'text-white text-md px-3 py-2 bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700']) }}>
    {{ $slot }}
</button>
