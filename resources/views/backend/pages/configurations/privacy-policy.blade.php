<x-backend-layout>

    @section('title',__('configuration.edit_privacyPolicy_title').' | ')

    {{-- header content --}}
    <x-header-content title="configuration.edit_privacyPolicy">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('label.settings') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('settings.configurations.privacyPolicy') }}">{{ __('configuration.configuration') }}</a></li>
            <li class="breadcrumb-item active">{{ __('configuration.privacyPolicy') }}</li>
        </ol>
    </x-header-content>

    @if (session()->has('success'))
    <div
        id="notification"
        data-message="{{ session()->get('success') }}"
        data-status="success"
    ></div>
    @endif
    @if (session()->has('error'))
    <div
        id="notification"
        data-message="{{ session()->get('error') }}"
        data-status="error"
    ></div>
    @endif

    {{-- form edit --}}
    {{ Form::model( $data, ['route' => ['settings.configurations.privacyPolicyUpdate', $data->id], 'method' => 'PUT']) }}

    <div class="p-6 mt-4 overflow-hidden bg-white rounded-lg shadow-md">
        <div class="grid gap-4">
            {{ Form::formText('configuration.privacy_policy', 'privacy_policy') }}
        </div>
        <div class="pb-4 border-b border-dashed border-secondary/90"></div>

        <div class="-mx-6 -mb-6 bg-secondary-300">
            <div class="px-6 py-4 space-x-1 text-right">
                <x-button-primary>
                    {{ __('label.update') }}
                </x-button-primary>
            </div>
        </div>
    </div>

    {{ Form::close() }}
</x-backend-layout>
