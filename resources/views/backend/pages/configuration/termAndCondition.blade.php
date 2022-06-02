<x-backend-layout>

    @section('title','Term And Condition | ')

    <div class="relative">
        <div class="">I am Term And Condition</div>
        <div class="mt-4">
            <textarea
                name="term_and_condition"
                id="term_and_condition"
                cols="30"
                rows="10"
                class="w-full"
            >{{ $data->term_and_condition }}</textarea>
        </div>
    </div>
</x-backend-layout>
