<x-backend-layout>

    @section('title','Detail User | ')

    <div class="">
        <div class="inline-flex justify-end w-full">
            <a href="{{ route('accounts.roles.index') }}">
                <x-button-secondary>
                    {{ __('label.back') }}
                </x-button-secondary>
            </a>
        </div>
        <div class="p-4 mt-4 rounded-lg shadow-md bg-secondary">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $role->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Permissions:</strong>
                    @if(!empty($rolePermissions))
                    <div class="list-inside list-desc">
                        @foreach ($rolePermissions as $v)
                        <div class="list-item"> {{ $v->name }}</div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-backend-layout>
