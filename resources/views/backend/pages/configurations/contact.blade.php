<x-backend-layout>

    @section('title','Contact | ')

    <div class="relative">
        <div class="">I am Contact</div>
        <div class="mt-4">
            <textarea
                name="address"
                id="address"
                cols="30"
                rows="10"
                class="w-full"
            >{{ $data->address }}</textarea>
            <input
                type="text"
                class="w-full"
                value="{{ $data->email }}"
            >
            <input
                type="text"
                class="w-full"
                value="{{ $data->phone }}"
            >
            <input
                type="text"
                class="w-full"
                value="{{ $data->map_src }}"
            >
            <input
                type="text"
                class="w-full"
                value="{{ $data->map_link }}"
            >
        </div>
    </div>
</x-backend-layout>
