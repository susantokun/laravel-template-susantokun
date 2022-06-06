<x-backend-layout>

    @section('title','Roles | ')

    <div class="relative">
        <div class="inline-flex items-center justify-between w-full">
            <a href="{{ route('roles.create') }}">
                <x-button-primary>
                    {{ __('label.add_new') }}
                </x-button-primary>
            </a>
        </div>
        <div class="mt-4">
            <div
                id="role"
                data-roles="{{ auth()->user()->getRoleNames() }}"
            ></div>
        </div>
    </div>
</x-backend-layout>
