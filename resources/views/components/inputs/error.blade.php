@props(['field'])

@if($errors->has($field))
    <span class="error">{{ $message }}</span>
@endif