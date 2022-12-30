<SpladeTextarea
    {{ $attributes->only(['v-if', 'v-show']) }}
    :autosize="@js($attributes->has('autosize') ? (bool) $attributes->get('autosize') : $defaultAutosizeValue)"
    v-model="{{ $vueModel() }}"
>
    @includeWhen($label, 'splade::form.label', ['label' => $label])

    <textarea
        {{ $attributes->except(['v-if', 'v-show', 'autosize'])->class(
            'form-control'
        )->merge([
            'name' => $name,
            'v-model' => $vueModel(),
            'data-validation-key' => $validationKey(),
        ]) }}
    />

    @includeWhen($help, 'splade::form.help', ['help' => $help])
    @includeWhen($showErrors, 'splade::form.error', ['name' => $validationKey()])
</SpladeTextarea>