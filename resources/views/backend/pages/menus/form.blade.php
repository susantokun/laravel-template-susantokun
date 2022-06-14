<div class="p-6 mt-4 overflow-hidden bg-white rounded-lg shadow-md">
    <div class="grid gap-4 md:grid-cols-6">
        {{-- {{ Form::formSelect('menu.role_id', 'role_id', $roles) }}
        {{ Form::formSelect('menu.parent_id', 'parent_id', $parents) }} --}}

        <div
            class="col-span-6"
            id="menuForm"
        ></div>

        {{ Form::formText('menu.title', 'title') }}
        {{ Form::formSelect('menu.route_name', 'route_name', $routes) }}
        {{ Form::formText('menu.route_group', 'route_group', null, ['placeholder' => 'kosongkan jika menu induk']) }}
        {{ Form::formText('menu.icon', 'icon') }}
        {{ Form::formText('menu.order', 'order') }}
        {{ Form::formSelect('menu.status', 'status', [1 => 'Active', 0 => 'Non Active']) }}
    </div>
    <div class="pb-4 border-b border-dashed border-secondary/90"></div>

    <div class="-mx-6 -mb-6 bg-secondary-300">
        <div class="px-6 py-4 space-x-1 text-right">
            <a href="{{ route('settings.menus.index') }}">
                <x-button-secondary type="button">
                    {{ __('label.back') }}
                </x-button-secondary>
            </a>
            <x-button-primary>
                {{ isset($menu) ? __('label.update') : __('label.store') }}
            </x-button-primary>
        </div>
    </div>
</div>
