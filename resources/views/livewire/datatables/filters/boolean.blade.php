<div x-data class="row">
    <div class="col-12">
        <select
            x-ref="select"
            name="{{ $name }}"
            class="form-control"
            wire:input="doBooleanFilter('{{ $index }}', $event.target.value)"
            x-on:input="$refs.select.value=''"
        >
            <option value=""></option>
            <option value="0">{{ __('No') }}</option>
            <option value="1">{{ __('Yes') }}</option>
        </select>
    </div>
    <div class="col-12">
        @isset($this->activeBooleanFilters[$index])
        @if($this->activeBooleanFilters[$index] == 1)
        <button wire:click="removeBooleanFilter('{{ $index }}')"
            class="btn btn-block btn-dark btn-xs">
            <i class="fas fa-times"></i>
            <span>{{ __('YES') }}</span>
        </button>
        @elseif(strlen($this->activeBooleanFilters[$index]) > 0)
        <button wire:click="removeBooleanFilter('{{ $index }}')"
            class="btn btn-block btn-dark btn-xs">
            <i class="fas fa-times"></i>
            <span>{{ __('No') }}</span>
        </button>
        @endif
        @endisset
    </div>
</div>