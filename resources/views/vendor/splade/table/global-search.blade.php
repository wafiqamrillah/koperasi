<div class="relative">
    <input
      class="tw-block tw-w-full sm:tw-pl-9 tw-text-sm tw-rounded-md tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-border-gray-300"
      placeholder="{{ $table->searchInputs('global')->label }}"
      value="{{ $table->searchInputs('global')->value }}"
      type="text"
      name="searchInput-global"
      v-bind:class="{ 'opacity-50': table.isLoading }"
      v-bind:disabled="table.isLoading"
      @input="table.debounceUpdateQuery('filter[global]', $event.target.value, $event.target)"
    >
    <div class="tw-absolute tw-inset-y-0 tw-left-0 tw-pl-3 tw-hidden sm:tw-flex tw-items-center tw-pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
        </svg>
    </div>
</div>