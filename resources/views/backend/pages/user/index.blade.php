<x-backend-layout>

    @section('title','Users | ')

    <div class="">
        <div class="">I am User</div>
        <div class="mt-4">
            <div
                id="user"
                data-users="{{ $users }}"
            ></div>
        </div>
    </div>
</x-backend-layout>
