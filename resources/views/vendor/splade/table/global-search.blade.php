<input
    type="text"
    name="searchInput-global"
    class="form-control float-right"
    placeholder="{{ $table->searchInputs('global')->label }}"
    value="{{ $table->searchInputs('global')->value }}"
    v-bind:style="{ 'opacity: 0.5;': table.isLoading }"
    v-bind:disabled="table.isLoading"
    @input="table.debounceUpdateQuery('filter[global]', $event.target.value, $event.target)">