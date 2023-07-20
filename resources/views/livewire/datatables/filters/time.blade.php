<div
    x-data
    class="row">
    <div class="col-12">
        <div class="input-group input-group-sm">
            <input
                x-ref="start" 
                type="time"
                wire:change="doTimeFilterStart('{{ $index }}', $event.target.value)"
                class="form-control"
            />
            <div class="input-group-append">
                <button
                    type="button"
                    x-on:click="$refs.start.value=''"
                    wire:click="doTimeFilterStart('{{ $index }}', '')"
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
                type="time"
                wire:change="doTimeFilterEnd('{{ $index }}', $event.target.value)"
                class="form-control">
            <div class="input-group-append">
                <button
                    type="button"
                    x-on:click="$refs.end.value=''"
                    wire:click="doTimeFilterEnd('{{ $index }}', '')"
                    tabindex="-1"
                    class="btn btn-outline-secondary">
                    <i class="far fa-times-circle"></i>
                </button>
            </div>
        </div>
    </div>
</div>