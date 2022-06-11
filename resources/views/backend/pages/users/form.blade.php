<div class="p-6 mt-4 overflow-hidden bg-white rounded-lg shadow-md">
    <div class="grid gap-4 md:grid-cols-6">
        {{ Form::formText('user.username', 'username') }}
        {{ Form::formText('user.first_name', 'first_name') }}
        {{ Form::formText('user.last_name', 'last_name') }}
        {{ Form::formText('user.full_name', 'full_name') }}
        {{ Form::formNumber('user.phone', 'phone') }}
        {{ Form::formEmail('user.email', 'email') }}
        {{ Form::formText('user.image_name', 'image_name') }}
        {{ Form::formFile('user.image_file', 'image_file') }}
        {{ Form::formSelect('user.status', 'status', ['active' => 'Active', 'nonactive' => 'Non Active', 'suspend' => 'Suspend']) }}
        {{ Form::formPassword('user.password', 'password') }}
        {{ Form::formPassword('user.confirmPassword', 'confirm-password') }}
        {{ Form::formSelectMulti('user.roles', 'roles', $roles, isset($user) ? $userRole: null ) }}
    </div>
    <div class="pb-4 border-b border-dashed border-secondary/90"></div>

    <div class="-mx-6 -mb-6 bg-secondary-300">
        <div class="px-6 py-4 space-x-1 text-right">
            <a href="{{ route('accounts.users.index') }}">
                <x-button-secondary type="button">
                    {{ __('label.back') }}
                </x-button-secondary>
            </a>
            <x-button-primary>
                {{ isset($user) ? __('label.update') : __('label.store') }}
            </x-button-primary>
        </div>
    </div>
</div>
