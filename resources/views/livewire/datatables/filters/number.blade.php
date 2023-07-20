<div class="row">
    <div x-data class="col-12">
        <div class="input-group input-group-sm">
            <input
                x-ref="min"
                type="number"
                wire:input.debounce.500ms="doNumberFilterStart('{{ $index }}', $event.target.value)"
                class="form-control"
                placeholder="{{ __('MIN') }}"
            />
            <div class="input-group-append">
                <button
                    type="button"
                    x-on:click="$refs.min.value=''"
                    wire:click="doNumberFilterStart('{{ $index }}', '')"
                    tabindex="-1"
                    class="btn btn-outline-secondary">
                    <i class="far fa-times-circle"></i>
                </button>
            </div>
        </div>
    </div>

    <div x-data class="col-12">
        <div class="input-group input-group-sm">
            <input
                x-ref="max"
                type="number"
                wire:input.debounce.500ms="doNumberFilterEnd('{{ $index }}', $event.target.value)"
                class="form-control"
                placeholder="{{ __('MAX') }}"
            />
            <div class="input-group-append">
                <button
                    type="button"
                    x-on:click="$refs.max.value=''"
                    wire:click="doNumberFilterEnd('{{ $index }}', '')"
                    tabindex="-1"
                    class="btn btn-outline-secondary">
                    <i class="far fa-times-circle"></i>
                </button>
            </div>
        </div>
    </div>
</div>