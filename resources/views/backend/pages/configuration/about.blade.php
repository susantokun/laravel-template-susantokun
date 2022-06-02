<x-backend-layout>

    @section('title','About | ')

    <div class="relative">
        <div class="">I am About</div>
        <div class="mt-4">
            <textarea
                name="about"
                id="about"
                cols="30"
                rows="10"
                class="w-full"
            >{{ $data->about }}</textarea>
        </div>
    </div>
</x-backend-layout>
