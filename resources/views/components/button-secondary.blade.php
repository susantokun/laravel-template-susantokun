<button {{$attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 text-sm font-semibold tracking-wide text-gray-600 transition
    duration-150 ease-in-out border border-transparent rounded-md shadow-sm select-none bg-secondary hover:bg-secondary/80 active:bg-secondary/90
    focus:outline-none
    focus:border-secondary/500 focus:ring ring-secondary/30 disabled:opacity-25']) }}>
    {{ $slot }}
</button>
