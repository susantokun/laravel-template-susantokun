<button {{$attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 text-sm font-semibold tracking-wide text-gray-600 transition
    duration-150 ease-in-out border border-gray-200 rounded-md shadow-sm select-none bg-secondary hover:bg-secondary/30 active:bg-secondary/90
    focus:outline-none
    focus:border-gray-400 focus:ring ring-gray-200 disabled:opacity-25']) }}>
    {{ $slot }}
</button>
