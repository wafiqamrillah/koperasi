<SpladeInput
{{ $attributes->only(['v-if', 'v-show'])->class(['hidden' => $isHidden()]) }}
:flatpickr="@js($flatpickrOptions())"
:js-flatpickr-options="{!! $jsFlatpickrOptions !!}"
v-model="{{ $vueModel() }}"
#default="inputScope"
>
@includeWhen($label, 'splade::form.label', ['label' => $label])

<div class="{{ ($prepend || $append) ? "input-group" : "form-group" }} mb-3">
    @if ($prepend)
        <div class="input-group-prepend">
            {!! $prepend !!}
        </div>
    @endif

    <input
        {{ 
            $attributes->except(['v-if', 'v-show'])->class([
                'form-control',
            ])->merge([
                'name' => $name,
                'type' => $type,
                'v-model' => $flatpickrOptions() ? null : $vueModel(),
                'data-validation-key' => $validationKey(),
            ])
        }}
        />

    @if ($append)
        <div class="input-group-append">
            {!! $append !!}
        </div>
    @endif
</div>

@include('splade::form.help', ['help' => $help])
@includeWhen($showErrors, 'splade::form.error', ['name' => $validationKey()])
</SpladeInput>