<x-backend-layout>

    @section('title',__('fileManager.show_title').' | ')

    {{-- header content --}}
    <x-header-content title="fileManager.show">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('label.accounts') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('settings.file-managers.index') }}">{{ __('fileManager.fileManager') }}</a></li>
            <li class="breadcrumb-item active">{{ __('label.show') }}</li>
        </ol>
    </x-header-content>

    <div class="show">

        <div class="show_group">
            <x-label class="show_group_label">{{ __('fileManager.code') }}</x-label>
            <div class="show_group_content">{{ $fileManager->code }}</div>
        </div>

        <div class="show_group">
            <x-label class="show_group_label">{{ __('fileManager.name') }}</x-label>
            <div class="show_group_content">{{ $fileManager->name }}</div>
        </div>


        <div class="show_group">
            <x-label class="show_group_label">{{ __('fileManager.path') }}</x-label>
            <div class="show_group_content">{{ $fileManager->path }}</div>
        </div>


        <div class="show_group">
            <x-label class="show_group_label">{{ __('label.created_at') }}</x-label>
            <div class="show_group_content">{{ $fileManager->created_at }}</div>
        </div>
        <div class="show_group">
            <x-label class="show_group_label">{{ __('label.updated_at') }}</x-label>
            <div class="show_group_content">{{ $fileManager->updated_at }}</div>
        </div>

    </div>
</x-backend-layout>
