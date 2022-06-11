<div class="p-6 mt-4 overflow-hidden bg-white rounded-lg shadow-md">
    <div class="grid gap-4 md:grid-cols-6">

        {{-- name --}}
        <div class="@if (isset($permissionsOperation))col-span-3 @else col-span-6 @endif">
            <x-label>{{ __('permission.name') }}</x-label>
            {!! Form::text('name', null, array('placeholder' => __('permission.name'), 'class' => 'form-input block w-full mt-1')) !!}
            @error('name')
            <p class="mt-1 text-xs font-medium text-danger">{{ $message }}</p>
            @enderror
        </div>

        {{-- operation --}}
        @if (isset($permissionsOperation))
        <div class="col-span-3">
            <x-label>{{ __('permission.permissionsOperation') }} <span class="italic">({{ __('label.optional') }})</span></x-label>
            @foreach($permissionsOperation as $value)
            <label class="cursor-pointer select-none">
                {!! Form::checkbox('permissionsOperation[]', $value, false,
                array('class'
                =>
                'form-checkbox','multiple')) !!}
                {{ $value }}
                <br />
            </label>
            @endforeach

            @error('permissions')
            <p class="mt-1 text-xs font-medium text-danger">{{ $message }}</p>
            @enderror
        </div>
        @endif

    </div>

    <div class="pb-4 border-b border-dashed border-secondary/90"></div>

    {{-- action --}}
    <div class="-mx-6 -mb-6 bg-secondary-300">
        <div class="px-6 py-4 space-x-1 text-right">
            <a href="{{ route('accounts.permissions.index') }}">
                <x-button-secondary type="button">
                    {{ __('label.back') }}
                </x-button-secondary>
            </a>
            <x-button-primary>
                {{ isset($permission) ? __('label.update') : __('label.store') }}
            </x-button-primary>
        </div>
    </div>

</div>
