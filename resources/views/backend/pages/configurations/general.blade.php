<x-backend-layout>

    @section('title',__('configuration.edit_general_title').' | ')

    {{-- header content --}}
    <x-header-content title="configuration.edit_general">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('label.settings') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('settings.configurations.general') }}">{{ __('configuration.configuration') }}</a></li>
            <li class="breadcrumb-item active">{{ __('configuration.general') }}</li>
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
    {{ Form::model( $data, ['route' => ['settings.configurations.generalUpdate', $data->id], 'method' => 'PUT', 'enctype' =>
    'multipart/form-data'] )
    }}

    <div class="p-6 mt-4 overflow-hidden bg-white rounded-lg shadow-md">
        <div class="grid gap-4 md:grid-cols-6">
            {{ Form::formText('configuration.code', 'code', null, ['disabled']) }}
            {{ Form::formText('configuration.title', 'title') }}
            {{ Form::formText('configuration.title_short', 'title_short') }}
            {{ Form::formText('configuration.desc', 'desc') }}
            {{ Form::formText('configuration.slogan', 'slogan') }}
            {{ Form::formText('configuration.author', 'author') }}
            {{ Form::formText('configuration.favicon_name', 'favicon_name') }}
            {{ Form::formFile('configuration.favicon_file', 'favicon_file') }}
            {{ Form::formText('configuration.logo_name', 'logo_name') }}
            {{ Form::formFile('configuration.logo_file', 'logo_file') }}
            {{ Form::formText('configuration.keywords', 'keywords') }}
            {{ Form::formText('configuration.metatext', 'metatext') }}
            {{ Form::formText('configuration.place_of_birth', 'place_of_birth') }}
            {{ Form::formText('configuration.date_of_birth', 'date_of_birth') }}
            {{ Form::formText('configuration.api_key', 'api_key') }}
            {{ Form::formSelect('configuration.status', 'status', [1 => 'Active', 0 => 'Non Active']) }}
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
