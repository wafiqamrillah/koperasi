<div
    v-show="@js($searchInput->value !== null) || table.isForcedVisible(@js($searchInput->key))"
    class="tw-px-4 sm:tw-px-0"
>
    <div class="tw-flex tw-rounded-md tw-shadow-sm tw-relative tw-mt-3">
        <label
            for="{{ $searchInput->key }}"
            class="tw-inline-flex tw-items-center tw-px-4 tw-rounded-l-md tw-border tw-border-r-0 tw-border-gray-300 tw-bg-gray-50 tw-text-gray-500 tw-text-sm"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5 tw-mr-2 tw-text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
            </svg>

            <span>{{ $searchInput->label }}</span>
        </label>

        <input
            name="searchInput-{{ $searchInput->key }}"
            value="{{ $searchInput->value }}"
            type="text"
            class="tw-flex-1 tw-min-w-0 tw-block tw-w-full tw-px-3 tw-py-2 tw-rounded-none tw-rounded-r-md focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-text-sm tw-border-gray-300"
            v-bind:class="{ 'opacity-50': table.isLoading }"
            v-bind:disabled="table.isLoading"
            @input="table.debounceUpdateQuery('filter[{{ $searchInput->key }}]', $event.target.value, $event.target)"
        />

        <div class="tw-absolute tw-inset-y-0 tw-right-0 tw-pr-3 tw-flex tw-items-center" >
            <button
                class="tw-rounded-md tw-text-gray-400 hover:tw-text-gray-500 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500"
                @click.prevent="table.disableSearchInput(@js($searchInput->key))"
                dusk="remove-search-row-{{ $searchInput->key }}"
            >
                <span class="tw-sr-only">Remove search</span>

                <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</div>
