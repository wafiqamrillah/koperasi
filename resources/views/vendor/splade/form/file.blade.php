<SpladeFile
    :form="form"
    :field="@js($formKey())"
    :multiple="@js($multiple)"
    :placeholder="@js($placeholder)"
    :filepond="@js($filepondOptions())"
    :js-filepond-options="{!! $jsFilepondOptions() !!}"
    :server="@js($server)"
    :preview="@js($preview)"
    :accept="@js($accept)"
    :existing-suffix="@js($existingSuffix)"
    :order-suffix="@js($orderSuffix)"
    :min-file-size="@js($minSize)"
    :max-file-size="@js($maxSize)"
    :min-image-width="@js($minWidth)"
    :max-image-width="@js($maxWidth)"
    :min-image-height="@js($minHeight)"
    :max-image-height="@js($maxHeight)"
    :min-image-resolution="@js($minResolution)"
    :max-image-resolution="@js($maxResolution)"
    v-on:start-uploading="form.$startUploading"
    v-on:stop-uploading="form.$stopUploading"
    :dusk="@js($attributes->get('dusk'))"
    {{ $attributes->only(['v-if', 'v-show']) }}
>
    <template #default="{!! $scope !!}">
        @includeWhen($label, 'splade::form.label', ['label' => $label])

        @if($filepond)
            <input {{ $attributes->except(['v-if', 'v-show'])->merge([
                'name' => $name,
                'multiple' => $multiple,
                'type' => 'file',
                'data-validation-key' => $validationKey(),
            ]) }}
            />
        @else
            <a @submit.prevent>
                <div class="custom-file">
                    <input @change="file.handleFileInput" {{ $attributes->except(['v-if', 'v-show'])->class([
                        'custom-file-input'
                    ])->merge([
                        'name' => $name,
                        'multiple' => $multiple,
                        'type' => 'file',
                        'data-validation-key' => $validationKey(),
                    ]) }}
                        @if(count($accept) > 0)
                            accept="{{ implode(',', $accept) }}"
                        @endif
                    />
                    <label class="custom-file-label" @if(isset($for)) for="{{ $for }}" @endif>Choose file</label>

                    @if(trim($slot))
                        {{ $slot }}
                    @else
                        {{ $placeholder }}
                    @endif
                </div>
            </a>
        @endif

        @includeWhen($help, 'splade::form.help', ['help' => $help])

        @if(!$filepond)
            <div class="mt-2 text-sm" v-if="file.filenames.length > 0">
                <p v-for="(filename, key) in file.filenames" v-bind:key="key" v-text="filename" style="font-style: italic;" />
            </div>
        @endif

        @includeWhen($showErrors, 'splade::form.error', ['name' => $validationKey()])
    </template>
</SpladeFile>