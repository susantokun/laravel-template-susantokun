<div class="p-6 mt-4 overflow-hidden bg-white rounded-lg shadow-md">
    <div class="grid gap-4 md:grid-cols-6">

        {{-- name --}}
        <div class="col-span-3">
            <x-label>{{ __('role.name') }}</x-label>
            {!! Form::text('name', null, array('placeholder' => __('role.name'), 'class' => 'form-input block w-full mt-1')) !!}
            @error('name')
            <p class="mt-1 text-xs font-medium text-danger">{{ $message }}</p>
            @enderror
        </div>

        {{-- permissions --}}
        <div class="col-span-3">
            <x-label>{{ __('role.permissions') }}</x-label>
            @foreach($permissions as $value)
            <label class="cursor-pointer select-none">
                {!! Form::checkbox('permissions[]', $value->id, isset($rolePermissions) ? in_array($value->id, $rolePermissions) ? true : false : false,
                array('class'
                =>
                'form-checkbox','multiple')) !!}
                {{ $value->name }}
                <br />
            </label>
            @endforeach

            {{-- @foreach($permission as $value)
            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                {{ $value->name }}</label>
            <br />
            @endforeach --}}

            @error('permissions')
            <p class="mt-1 text-xs font-medium text-danger">{{ $message }}</p>
            @enderror
        </div>

    </div>

    <div class="pb-4 border-b border-dashed border-secondary/90"></div>

    {{-- action --}}
    <div class="-mx-6 -mb-6 bg-secondary-300">
        <div class="px-6 py-4 space-x-1 text-right">
            <a href="{{ route('accounts.roles.index') }}">
                <x-button-secondary type="button">
                    {{ __('label.back') }}
                </x-button-secondary>
            </a>
            <x-button-primary>
                {{ isset($role) ? __('label.update') : __('label.store') }}
            </x-button-primary>
        </div>
    </div>

</div>
