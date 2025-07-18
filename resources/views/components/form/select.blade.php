@props([
    'options' => [],
    'optionsid' => [],
    'name',
    'id' => null,
    'label'=>'',
    'value'=> null,
])
@if ($label)
    <label class="form-label" for="{{$name}}">
        {{ $label }}
    </label>
@endif

<select 
    id="{{$id ?? $name}}" 
    name="{{$name}}" 
    {{$attributes->class([
        'form-select',
        'is-invalid' => $errors->has($name)
    ])}}
    >
    <option value="" @selected(old($name, $value) == null)>إختر القيمة</option>
    @if ($optionsid)
        @foreach ($optionsid as $option)
            <option value="{{ $option->id }}" @selected(old($name, $value) == $option->id)>{{ $option->name }}</option>
        @endforeach
    @endif
    @if ($options )
        @foreach ($options as $option)
            <option value="{{ $option }}" @selected(old($name, $value) == $option)>{{ $option }}</option>
        @endforeach
    @endif
</select>

{{-- Validation --}}
@error($name)
    <div class="invalid-feedback">
        {{$message}}
    </div>
@enderror
