<button {{ $attributes->merge(['type' => 'button', 'class' => 'text-white text-sm px-3 py-1.5 bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-center mr-2 mb-2']) }}>
    {{ $slot }}
</button>
