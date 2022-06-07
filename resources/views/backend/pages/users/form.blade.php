<div class="p-6 mt-4 bg-white rounded-lg shadow-md">
    <div class="grid grid-cols-6 gap-4">

        {{-- name --}}
        <div class="col-span-3">
            <x-label>{{ __('user.name') }}</x-label>
            {!! Form::text('name', null, array('placeholder' => __('user.name'), 'class' => 'form-input block w-full mt-1')) !!}
            @error('name')
            <p class="mt-1 text-xs font-medium text-danger">{{ $message }}</p>
            @enderror
        </div>

        {{-- email --}}
        <div class="col-span-3">
            <x-label>{{ __('user.email') }}</x-label>
            {!! Form::text('email', null, array('placeholder' => __('user.email'), 'class' => 'form-input block w-full mt-1')) !!}
            @error('email')
            <p class="mt-1 text-xs font-medium text-danger">{{ $message }}</p>
            @enderror
        </div>

        {{-- password --}}
        <div class="col-span-3">
            <x-label>{{ __('user.password') }}</x-label>
            {!! Form::password('password', array('placeholder' => __('user.password'), 'class' => 'form-input block w-full mt-1', 'autocomplete' => 'off')) !!}
            @error('password')
            <p class="mt-1 text-xs font-medium text-danger">{{ $message }}</p>
            @enderror
        </div>

        {{-- confirmPassword --}}
        <div class="col-span-3">
            <x-label>{{ __('user.confirmPassword') }}</x-label>
            {!! Form::password('confirm-password', array('placeholder' => __('user.confirmPassword'), 'class' => 'form-input block w-full mt-1')) !!}
            @error('confirmPassword')
            <p class="mt-1 text-xs font-medium text-danger">{{ $message }}</p>
            @enderror
        </div>

        {{-- roles --}}
        <div class="col-span-3">
            <x-label>{{ __('user.roles') }}</x-label>
            {!! Form::select('roles[]', $roles,[], array('class' => 'form-select block w-full mt-1','multiple')) !!}
            @error('roles')
            <p class="mt-1 text-xs font-medium text-danger">{{ $message }}</p>
            @enderror
        </div>

    </div>

    {{-- action --}}
    <div class="mt-4 -mx-6 -mb-6 bg-secondary-300 dark:bg-secondary-700">
        <div class="px-6 py-4 space-x-1 text-right">
            <a href="{{ route('accounts.users.index') }}">
                <x-button-secondary type="button">
                    {{ __('label.back') }}
                </x-button-secondary>
            </a>
            <x-button-primary>
                {{ __('label.create') }}
            </x-button-primary>
        </div>
    </div>

</div>
