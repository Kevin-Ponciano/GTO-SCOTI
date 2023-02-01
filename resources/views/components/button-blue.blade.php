<button {{ $attributes->merge(['type' => 'button', 'class' => 'text-white text-md px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 rounded-lg mr-2 mb-2']) }}>
    {{ $slot }}
</button>
