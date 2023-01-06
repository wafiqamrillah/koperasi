<div
    v-show="@js($searchInput->value !== null) || table.isForcedVisible(@js($searchInput->key))"
    class="form-group row"
>
    <label
        for="{{ $searchInput->key }}"
        class="col-sm-2 col-form-label">
        {{ $searchInput->label }}
    </label>

    <div class="col-sm-10">
        <div class="input-group input-group-sm">
            <input
                name="searchInput-{{ $searchInput->key }}"
                value="{{ $searchInput->value }}"
                type="text"
                class="form-control"
                v-bind:class="{ 'tw-opacity-50': table.isLoading }"
                v-bind:disabled="table.isLoading"
                @input="table.debounceUpdateQuery('filter[{{ $searchInput->key }}]', $event.target.value, $event.target)"
            />
    
            <span class="input-group-append">
                <button
                    type="button"
                    class="btn btn-danger btn-flat"
                    @click.prevent="table.disableSearchInput(@js($searchInput->key))"
                    dusk="remove-search-row-{{ $searchInput->key }}"
                >
                    <i class="fa-solid fa-times"></i>
                </button>
            </span>
        </div>
    </div>
</div>
