@php
    $class ??= null;
    $label ??= null;
    $name ??= '';
    $value ??= '';
@endphp

<div>
    <label class="form-check-label" for="{{ $name }}">{{ $label }}</label>

    {{-- Select --}}
    <select name="{{ $name }}[]" @class(['form-control  fs-5', $class])" id="{{ $name }} tom-select-it" multiple>
        @foreach ($options as $k => $v)
            <option @selected($value->contains($k)) value="{{ $k }}">{{ $v }}</option>
        @endforeach

    </select>
    {{-- The label --}}

    {{-- Displaying forms errors --}}
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
