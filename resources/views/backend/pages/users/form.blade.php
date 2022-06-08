<div class="p-6 mt-4 overflow-hidden bg-white rounded-lg shadow-md">
    <div class="grid gap-4 md:grid-cols-6">

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
            {!! Form::select('roles[]', $roles, isset($user) ? $userRole: null, array('class' => 'form-select block w-full
            mt-1','multiple')) !!}
            @error('roles')
            <p class="mt-1 text-xs font-medium text-danger">{{ $message }}</p>
            @enderror
        </div>

    </div>

    <div class="pb-4 border-b border-dashed border-secondary/90"></div>

    {{-- action --}}
    <div class="-mx-6 -mb-6 bg-secondary-300">
        <div class="px-6 py-4 space-x-1 text-right">
            <a href="{{ route('accounts.users.index') }}">
                <x-button-secondary type="button">
                    {{ __('label.back') }}
                </x-button-secondary>
            </a>
            <x-button-primary>
                {{ isset($user) ? __('label.update') : __('label.store') }}
            </x-button-primary>
        </div>
    </div>

</div>
