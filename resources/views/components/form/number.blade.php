<div class="col-span-3">
    {{ Form::label(__($label), null, ['class' => 'form-label']) }}
    {{ Form::number($name, $value, array_merge(['class' => 'form-input block w-full mt-1'], $attributes)) }}
    @error($name)
    <p class="mt-1 text-xs font-medium text-danger">{{ $message }}</p>
    @enderror
</div>
