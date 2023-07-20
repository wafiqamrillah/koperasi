<div x-data class="row">
    <div class="col-12">
        <div class="input-group input-group-sm">
            <input
                x-ref="start" 
                type="datetime-local"
                wire:change="doDatetimeFilterStart('{{ $index }}', $event.target.value)"
                value="{{ $this->activeDatetimeFilters[$index]['start'] ?? ''}}"
                class="form-control"
            />
            <div class="input-group-append">
                <button
                    type="button"
                    x-on:click="$refs.start.value=''"
                    wire:click="doDatetimeFilterStart('{{ $index }}', '')"
                    tabindex="-1"
                    class="btn btn-outline-secondary">
                    <i class="far fa-times-circle"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="input-group input-group-sm">
            <input
                x-ref="end" 
                type="datetime-local"
                wire:change="doDatetimeFilterEnd('{{ $index }}', $event.target.value)"
                value="{{ $this->activeDatetimeFilters[$index]['end'] ?? ''}}"
                class="form-control">
            <div class="input-group-append">
                <button
                    type="button"
                    x-on:click="$refs.end.value=''"
                    wire:click="doDatetimeFilterEnd('{{ $index }}', '')"
                    tabindex="-1"
                    class="btn btn-outline-secondary">
                    <i class="far fa-times-circle"></i>
                </button>
            </div>
        </div>
    </div>
</div>