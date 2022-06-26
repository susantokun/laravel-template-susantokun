<x-backend-layout>

    @section('title',__('fileManager.edit_title').' | ')

    {{-- header content --}}
    <x-header-content title="fileManager.edit">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('label.accounts') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('settings.file-managers.index') }}">{{ __('fileManager.fileManager') }}</a></li>
            <li class="breadcrumb-item active">{{ __('label.edit') }}</li>
        </ol>
    </x-header-content>

    {{-- form edit --}}
    {{ Form::model( $fileManager, ['route' => ['settings.file-managers.update', $fileManager->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data'] ) }}
    @include('backend.pages.file-managers.form')
    {{ Form::close() }}
</x-backend-layout>
