{{-- Variables that should be use by my form components --}}
@php
    $label ??= null;
    $type ??= 'file';
    $class ??= null;
    $name ??= '';
    $value ??= '';
@endphp

<div @class(['form-group', $class])>
    {{-- The label --}}
    <label class="form-label" for="{{ $name }}">{{ $label }}</label>


    {{-- Inputs type --}}
    <input class="form-control @error('images') is-invalid @enderror" id="{{ $name }}" name="{{ $name }}"
        type="{{ $type }}"  placeholder="" multiple>

    {{-- Displaying forms errors --}}
    @error('images')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
