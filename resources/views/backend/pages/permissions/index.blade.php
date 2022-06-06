<x-backend-layout>

    @section('title','Permissions | ')

    <div class="relative">
        <div class="">I am Permissions</div>
        <div class="mt-4">
            <div
                id="permission"
                data-roles="{{ auth()->user()->getRoleNames() }}"
            ></div>
        </div>
    </div>
</x-backend-layout>
