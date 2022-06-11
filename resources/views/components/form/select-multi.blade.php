<div class="col-span-3">
    {{ Form::label(__($label), null, ['class' => 'form-label']) }}
    {{ Form::select($name.'[]', $value, $selected, array_merge(['class' => 'form-select block w-full mt-1', 'multiple'], $attributes)) }}
    @error($name)
    <p class="mt-1 text-xs font-medium text-danger">{{ $message }}</p>
    @enderror
</div>
