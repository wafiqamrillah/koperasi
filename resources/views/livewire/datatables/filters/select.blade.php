<div x-data class="row">
    <div class="col-12">
        <select
            x-ref="select"
            name="{{ $name }}"
            class="form-control"
            wire:input="doSelectFilter('{{ $index }}', $event.target.value)"
            x-on:input="$refs.select.value=''"
        >
            <option value=""></option>
            @foreach($options as $value => $label)
                @if(is_object($label))
                    <option value="{{ $label->id }}">{{ $label->name }}</option>
                @elseif(is_array($label))
                    <option value="{{ $label['id'] }}">{{ $label['name'] }}</option>
                @elseif(is_numeric($value))
                    <option value="{{ $label }}">{{ $label }}</option>
                @else
                    <option value="{{ $value }}">{{ $label }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="col-12">
        @foreach($this->activeSelectFilters[$index] ?? [] as $key => $value)
            <button
                wire:click="removeSelectFilter('{{ $index }}', '{{ $key }}')"
                class="btn btn-block btn-dark btn-xs">
                <i class="fas fa-times"></i>
                <span>{{ $this->getDisplayValue($index, $value) }}</span>
            </button>
        @endforeach
    </div>
</div>