<x-backend-layout>

    @section('title','Users | ')

    <div class="w-full">
        <div class="inline-flex items-center justify-between w-full">
            <a href="{{ route('users.create') }}">
                <x-button-primary>
                    {{ __('label.add_new') }}
                </x-button-primary>
            </a>
        </div>
        <div class="mt-4">
            <div
                id="user"
                data-users="{{ $users }}"
            ></div>
        </div>
    </div>
</x-backend-layout>
