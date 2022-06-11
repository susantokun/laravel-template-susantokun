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
            <x-label class="show_group_label">{{ __('user.username') }}</x-label>
            <div class="show_group_content">{{ $user->username }}</div>
        </div>

        <div class="show_group">
            <x-label class="show_group_label">{{ __('user.first_name') }}</x-label>
            <div class="show_group_content">{{ $user->first_name }}</div>
        </div>

        <div class="show_group">
            <x-label class="show_group_label">{{ __('user.last_name') }}</x-label>
            <div class="show_group_content">{{ $user->last_name }}</div>
        </div>

        <div class="show_group">
            <x-label class="show_group_label">{{ __('user.full_name') }}</x-label>
            <div class="show_group_content">{{ $user->full_name }}</div>
        </div>

        <div class="show_group">
            <x-label class="show_group_label">{{ __('user.phone') }}</x-label>
            <div class="show_group_content">{{ $user->phone }}</div>
        </div>

        <div class="show_group">
            <x-label class="show_group_label">{{ __('user.email') }}</x-label>
            <div class="show_group_content">{{ $user->email }}</div>
        </div>

        <div class="show_group">
            <x-label class="show_group_label">{{ __('user.image_name') }}</x-label>
            <div class="show_group_content">{{ $user->image_name }}</div>
        </div>

        <div class="show_group">
            <x-label class="show_group_label">{{ __('user.image_file') }}</x-label>
            <div class="show_group_content">
                <img
                    src="
                    @if (isset($user->image_file))
                        /storage/{{ $user->image_file }}
                    @else
                    {{ env('APP_URL_AVATAR_UI').$user->full_name }}
                    @endif
                    "
                    alt="{{ $user->image_name }}"
                    class="w-24 h-24 rounded-md"
                >
            </div>
        </div>

        <div class="show_group">
            <x-label class="show_group_label">{{ __('user.status') }}</x-label>
            <div class="show_group_content">{{ $user->status }}</div>
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

        <div class="show_group">
            <x-label class="show_group_label">{{ __('user.last_login_at') }}</x-label>
            <div class="show_group_content">
                @if (isset($user->last_login_at))
                {{ $user->last_login_at }}
                @endif
            </div>
        </div>

        <div class="show_group">
            <x-label class="show_group_label">{{ __('user.last_login_ip') }}</x-label>
            <div class="show_group_content">{{ $user->last_login_ip }}</div>
        </div>

        <div class="show_group">
            <x-label class="show_group_label">{{ __('label.created_at') }}</x-label>
            <div class="show_group_content">{{ $user->created_at }}</div>
        </div>
        <div class="show_group">
            <x-label class="show_group_label">{{ __('label.created_by') }}</x-label>
            <div class="show_group_content">{{ $user->created_by }}</div>
        </div>
        <div class="show_group">
            <x-label class="show_group_label">{{ __('label.updated_at') }}</x-label>
            <div class="show_group_content">{{ $user->updated_at }}</div>
        </div>
        <div class="show_group">
            <x-label class="show_group_label">{{ __('label.updated_by') }}</x-label>
            <div class="show_group_content">{{ $user->updated_by }}</div>
        </div>

    </div>
</x-backend-layout>
