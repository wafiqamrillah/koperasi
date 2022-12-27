<div {{ $attributes->only(['v-if', 'v-show'])->class('form-check') }}>
    <input {{ $attributes->except(['v-if', 'v-show'])->only(['class'])->class(
        'form-check-input'
    )->merge([
        'name' => $name,
        'value' => $value,
        'type' => 'checkbox',
        'v-model' => $vueModel(),
        'data-validation-key' => $validationKey(),
    ]) }} :true-value="@js($value)" :false-value="@js($falseValue)" />
    
    @if(trim($slot))
        <span class="form-check-label">{{ $slot }}</span>
    @else
        <span class="form-check-label">{{ $label }}</span>
    @endif

    @includeWhen($help, 'splade::form.help', ['help' => $help])
    @includeWhen($showErrors, 'splade::form.error', ['name' => $validationKey()])
</div>


