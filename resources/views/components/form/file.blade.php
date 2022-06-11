<div class="col-span-3">
    {{ Form::label(__($label), null, ['class' => 'form-label']) }}
    {{ Form::file($name, array_merge(['class' => 'form-input rounded-md shadow-sm transition duration-300
    focus:ring disabled:cursor-not-allowed disabled:opacity-50 file:rounded-l-0 file:mr-4 file:cursor-pointer file:border-0 file:py-2.5 file:px-4
    file:text-sm text-sm file:font-semibold py-0 px-0 block w-full mt-1 bg-white border-gray-300 focus:border-primary/60 focus:ring-primary/10
    file:bg-primary/80 file:text-white hover:file:bg-primary/60 focus:outline-none'], $attributes)) }}
    @error($name)
    <p class="mt-1 text-xs font-medium text-danger">{{ $message }}</p>
    @enderror
</div>
