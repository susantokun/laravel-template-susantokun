<x-backend-layout>

    @section('title',__('user.show_title').' | ')

    {{-- header content --}}
    <x-header-content title="user.show">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('label.accounts') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('accounts.users.index') }}">{{ __('user.user') }}</a></li>
            <li class="breadcrumb-item active">{{ __('label.show') }}</li>
        </ol>
    </x-header-content>

    <div class="show">

        <div class="show_group">
            <x-label class="show_group_label">{{ __('user.name') }}</x-label>
            <div class="show_group_content">{{ $user->name }}</div>
        </div>

        <div class="show_group">
            <x-label class="show_group_label">{{ __('user.email') }}</x-label>
            <div class="show_group_content">{{ $user->email }}</div>
        </div>

        <div class="show_group">
            <x-label class="show_group_label">{{ __('user.roles') }}</x-label>
            <div class="show_group_content">
                @if(!empty($user->getRoleNames()))
                @if ($user->getRoleNames()->count() <> 1)
                <div class="list-inside list-desc">
                    @foreach ($user->getRoleNames() as $item)
                    <div class="list-item">{{ $item }}</div>
                    @endforeach
                </div>
                @else
                {{ $user->getRoleNames()[0] }}
                @endif
                @endif
            </div>
        </div>

    </div>
</x-backend-layout>
