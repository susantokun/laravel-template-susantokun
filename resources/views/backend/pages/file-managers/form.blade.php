<div class="p-6 mt-4 overflow-hidden bg-white rounded-lg shadow-md">
    <div class="grid gap-4 md:grid-cols-6">
        {{ Form::formText('fileManager.code', 'code') }}
        {{ Form::formText('fileManager.name', 'name') }}
        {{ Form::formFile('fileManager.path', 'path') }}
    </div>
    <div class="pb-4 border-b border-dashed border-secondary/90"></div>

    <div class="-mx-6 -mb-6 bg-secondary-300">
        <div class="px-6 py-4 space-x-1 text-right">
            <a href="{{ route('settings.file-managers.index') }}">
                <x-button-secondary type="button">
                    {{ __('label.back') }}
                </x-button-secondary>
            </a>
            <x-button-primary>
                {{ isset($fileManager) ? __('label.update') : __('label.store') }}
            </x-button-primary>
        </div>
    </div>
</div>
