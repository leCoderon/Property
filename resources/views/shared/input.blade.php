{{-- Variables that should be use by my form components --}}
@php
    $label ??= null;
    $type ??= 'text';
    $class ??= null;
    $name ??= '';
    $value ??= '';
@endphp

<div @class(['form-group', $class])>
      {{-- The label --}}
      <label class="form-label" for="{{ $name }}">{{ $label }}</label>

    {{-- Textarea --}}
    @if ($type === 'textarea')
        <textarea class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}"
            placeholder="" rows="5">  {{ old($name, $value) }} </textarea>
    @else
        {{-- Inputs type --}}
        <input class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}"
            type="{{ $type }}" value="{{ old($name, $value) }}" placeholder="">
    @endif
  
    {{-- Displaying forms errors --}}
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
