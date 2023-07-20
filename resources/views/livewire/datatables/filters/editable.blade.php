<div x-data class="row">
    <div class="col-12">
        <input
            type="text"
            x-ref="input"
            wire:change="doTextFilter('{{ $index }}', $event.target.value)"
            x-on:change="$refs.input.value = ''"
            class="form-control"
        />
    </div>
    <div class="col-12">
        @foreach ($this->activeTextFilters[$index] ?? [] as $key => $value)
            <button
                wire:click="removeTextFilter('{{ $index }}', '{{ $key }}')"
                class="btn btn-block btn-dark btn-xs">
                <i class="fas fa-times"></i>
                <span>{{ $this->getDisplayValue($index, $value) }}</span>
            </button>
        @endforeach
    </div>
</div>