@props(['key' => 'email', 'placeholder' => null])

<div class="input-group mb-3">
    <input
        {{ $attributes }}
        wire:model.defer="{{ $key }}"
        type="email"
        name="{{ $key }}"
        class="form-control @errorClass($key)"
        value="{{ old($key) }}"
        placeholder="{{ $placeholder ?? trans("validation.attributes.$key") }}"
    >

    <x-inputs.fa fontAwesome="fa-envelope" />

    <x-inputs.error field="{{ $key }}" />
</div>
