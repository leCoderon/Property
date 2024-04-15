@php
    $class ??= null;
@endphp

<div @class(['form-check form-switch', $class])>

    {{-- Inputs type --}}
    <input type="hidden" name="{{$name}}" value="0">
    <input class="form-check-input @error($name) is-invalid @enderror" value="1" id="{{ $name }}" name="{{ $name }}"
    @checked(old($name, $value ?? false))    type="checkbox"  role="switch" >

    {{-- The label --}}
    <label class="form-check-label" for="{{ $name }}">{{ $label }}</label>

    {{-- Displaying forms errors --}}
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
