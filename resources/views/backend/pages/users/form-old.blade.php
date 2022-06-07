<div class="p-6 mt-4 bg-white rounded-lg shadow-md">

    {!! Form::open(array('route' => 'accounts.users.store','method'=>'POST')) !!}
    <div>
        <strong>Name:</strong>
        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-input block w-full mt-1')) !!}
    </div>
    <div class="form-group">
        <strong>Email:</strong>
        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-input block w-full mt-1')) !!}
    </div>
    <div class="form-group">
        <strong>Password:</strong>
        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-input block w-full mt-1')) !!}
    </div>
    <div class="form-group">
        <strong>Confirm Password:</strong>
        {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-input block w-full mt-1')) !!}
    </div>
    <div class="form-group">
        <strong>Role:</strong>
        {!! Form::select('roles[]', $roles,[], array('class' => 'form-select block w-full mt-1','multiple')) !!}
    </div>
    <div class="mt-4">
        <div class="my-4">
            @if (count($errors) > 0)
            <div class="text-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <div class="inline-flex justify-end w-full gap-2">
            <a href="{{ route('accounts.users.index') }}">
                <x-button-secondary type="button">
                    {{ __('label.back') }}
                </x-button-secondary>
            </a>
            <x-button-primary>
                {{ __('label.create') }}
            </x-button-primary>
        </div>
    </div>
    {!! Form::close() !!}
</div>