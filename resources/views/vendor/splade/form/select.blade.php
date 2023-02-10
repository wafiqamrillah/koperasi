@props(['required' => false])

<SpladeSelect
    {{ $attributes->only(['v-if', 'v-show']) }}
    :choices="@js($choicesOptions())"
    :js-choices-options="{!! $jsChoicesOptions() !!}"
    :multiple="@js($multiple)"
    :placeholder="@js($placeholderOption()?->toArray() ?: false)"
    v-model="{{ $vueModel() }}"
    :dusk="@js($attributes->get('dusk'))"
    :remote-url="{!! $remoteUrl ?: 'null' !!}"
    :option-value="@js($optionValue)"
    :option-label="@js($optionLabel)"
>
    <template #default="{!! $scope !!}">
        @includeWhen($label, 'splade::form.label', ['label' => $label])

        <div class="mb-3 form-group" v-bind:style="{ 'opacity: 0.5;' : select.loading }" style="position: relative;">
            <select {{ $attributes->except(['v-if', 'v-show'])->class([
                'form-control',
            ])->merge([
                'multiple' => $multiple,
                'name' => $name,
                'v-model' => $choicesOptions() ? null : $vueModel(),
                'data-validation-key' => $validationKey(),
            ]) }} >
                @if(trim($slot))
                    {{ $slot }}
                @else
                    @foreach($options() as $selectChild)
                        @include('splade::form.select-child', ['selectChild' => $selectChild])
                    @endforeach
                @endif
            </select>

            <div v-if="select.loading" style="position: absolute; width: 100%; height: 100%; top: 0px !important; right: 0px !important; bottom: 0px !important; left: 0px !important;">
                <div style="width: 100%; height: 100%; display: flex !important; flex-direction: row !important; align-items: center !important; justify-content: center !important;">
                    <i class="fa-solid fa-spin fa-circle-notch"></i>
                </div>
            </div>
        </div>

        @includeWhen($help, 'splade::form.help', ['help' => $help])
        @includeWhen($showErrors, 'splade::form.error', ['name' => $validationKey()])
    </template>
</SpladeSelect>