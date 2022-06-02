<x-backend-layout>
    @section('title','General | ')

    <div class="relative">
        <div class="">I am General</div>
        <div class="mt-4">
            <div
                id="general"
                data-data="{{ $data }}"
                data-role="{{ $role }}"
            ></div>
        </div>
    </div>

</x-backend-layout>
