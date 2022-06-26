<x-backend-layout>

    @section('title',__('fileManager.create_title').' | ')

    {{-- header content --}}
    <x-header-content title="fileManager.create">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('label.accounts') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('settings.file-managers.index') }}">{{ __('fileManager.fileManager') }}</a></li>
            <li class="breadcrumb-item active">{{ __('label.create') }}</li>
        </ol>
    </x-header-content>

    {{-- form create --}}
    {{ Form::open( array( 'route' => ['settings.file-managers.store'], 'enctype' => 'multipart/form-data' ) ) }}
    @include('backend.pages.file-managers.form')
    {{ Form::close() }}
</x-backend-layout>
