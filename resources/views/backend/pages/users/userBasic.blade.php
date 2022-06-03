<x-backend-layout>

    @section('title','Users | ')

    <div class="relative">
        <div class="">I am User</div>
        <div class="mt-4">
            <div
                id="userBasic"
                data-users="{{ $users }}"
            ></div>
        </div>
    </div>
</x-backend-layout>
