<div class="tw-flex tw-flex-row sm:tw-justify-end tw-mb-3 tw-px-4 sm:tw-px-0 -tw-mr-2 sm:-tw-mr-3">
    @if($table->hasExports() || $table->hasBulkActions())
        <div class="tw-order-1 tw-mr-2 sm:tw-mr-3" v-if="table.hasSelectedItems || @js($table->hasExports())">
            @include('splade::table.bulk-actions-exports')
        </div>
    @endif

    @if($table->hasFilters())
        <div class="tw-order-2 tw-mr-2 sm:tw-mr-3">
            @include('splade::table.filters')
        </div>
    @endif

    @if($table->searchInputs('global'))
        <div class="tw-w-full tw-order-3 tw-flex-grow tw-mr-2 sm:tw-mr-3">
            @include('splade::table.global-search')
        </div>
    @endif

    <button
        v-show="@js($canResetTable()) || table.columnsAreToggled || table.hasForcedVisibleSearchInputs"
        type="button"
        class="tw-order-6 sm:tw-order-4 tw-ml-auto tw-mr-2 sm:tw-mr-3 tw-bg-white tw-border tw-rounded-md tw-shadow-sm tw-px-2.5 sm:tw-px-4 tw-py-2 tw-inline-flex tw-justify-center tw-text-sm tw-font-medium tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500 tw-border-gray-300"
        @click.prevent="table.reset"
        dusk="reset-table"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5 tw-text-gray-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>

        <span class="tw-ml-2 tw-hidden sm:tw-inline">Reset</span>
    </button>

    @if($table->hasToggleableSearchInputs())
        <div class="tw-order-4 sm:tw-order-5 tw-mr-2 sm:tw-mr-3">
            @include('splade::table.add-search-row')
        </div>
    @endif

    @if($table->hasToggleableColumns())
        <div class="tw-order-5 sm:tw-order-6 tw-mr-2 sm:tw-mr-3">
            @include('splade::table.columns')
        </div>
    @endif
</div>