@props(['field'])

@foreach ($errors->get($field) as $message)
    <span class="error">{{ $message }}</span>
@endforeach