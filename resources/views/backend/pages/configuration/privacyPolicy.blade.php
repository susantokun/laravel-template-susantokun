<x-backend-layout>

    @section('title','Privacy Policy | ')

    <div class="relative">
        <div class="">I am Privacy Policy</div>
        <div class="mt-4">
            <textarea
                name="privacy_policy"
                id="privacy_policy"
                cols="30"
                rows="10"
                class="w-full"
            >{{ $data->privacy_policy }}</textarea>
        </div>
    </div>
</x-backend-layout>
