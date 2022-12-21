<div {{ $attributes->only(['v-if', 'v-show'])->class('form-control') }}>
    <label class="label cursor-pointer">
        @if(trim($slot))
            <span class="label-text">{{ $slot }}</span>
        @else
            <span class="label-text">{{ $label }}</span>
        @endif

        <input {{ $attributes->except(['v-if', 'v-show'])->only(['class'])->class(
            'checkbox'
        )->merge([
            'name' => $name,
            'value' => $value,
            'type' => 'checkbox',
            'v-model' => $vueModel(),
            'data-validation-key' => $validationKey(),
        ]) }} :true-value="@js($value)" :false-value="@js($falseValue)" />
    </label>

    @includeWhen($help, 'splade::form.help', ['help' => $help])
    @includeWhen($showErrors, 'splade::form.error', ['name' => $validationKey()])
</div>


