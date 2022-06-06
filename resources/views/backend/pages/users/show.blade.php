<x-backend-layout>

    @section('title','Detail User | ')

    <div class="">
        <div class="inline-flex justify-end w-full">
            <a href="{{ route('users.index') }}">
                <x-button-secondary>
                    {{ __('label.back') }}
                </x-button-secondary>
            </a>
        </div>
        <div class="p-4 mt-4 rounded-lg shadow-md bg-secondary">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $user->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    {{ $user->email }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Roles:</strong>
                    @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                    <label class="badge badge-success">{{ $v }}</label>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-backend-layout>
