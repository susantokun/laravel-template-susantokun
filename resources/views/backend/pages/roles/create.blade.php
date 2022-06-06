<x-backend-layout>

    @section('title','Create Role | ')

    <div class="">
        <div class="inline-flex justify-end w-full">
            <a href="{{ route('roles.index') }}">
                <x-button-secondary>
                    {{ __('label.back') }}
                </x-button-secondary>
            </a>
        </div>
        <div class="p-4 mt-4 rounded-lg shadow-md bg-secondary">

            {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
            <div class="row">
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control block w-full mt-1')) !!}
                </div>
                <div class="form-group">
                    <strong>Permission:</strong>
                    <br />
                    @foreach($permission as $value)
                    <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                        {{ $value->name }}</label>
                    <br />
                    @endforeach
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
                    <x-button-primary>
                        {{ __('label.create') }}
                    </x-button-primary>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</x-backend-layout>