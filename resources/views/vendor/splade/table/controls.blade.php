<div class="mb-3">
    <div class="input-group input-group-sm mb-2">
        @if ($table->hasToggleableSearchInputs() || $table->hasFilters())
            <span class="input-group-prepend btn-group">
                @includeWhen($table->hasToggleableSearchInputs(), 'splade::table.add-search-row')
                @includeWhen($table->hasFilters(), 'splade::table.filters')
            </span>
        @endif
        
        @includeWhen($table->searchInputs('global'), 'splade::table.global-search')

        <span v-if="@js($canResetTable()) || table.columnsAreToggled || table.hasForcedVisibleSearchInputs" class="input-group-append btn-group">
            <button
                v-show="@js($canResetTable()) || table.columnsAreToggled || table.hasForcedVisibleSearchInputs"
                type="button"
                class="btn btn-danger btn-flat"
                @click.prevent="table.reset"
                dusk="reset-table"
            >
                <i class="fa-solid fa-times"></i>
        
                <span style="display: inline; margin-left: 0.5rem;">Reset</span>
            </button>

            @includeWhen($table->hasToggleableColumns(), 'splade::table.columns')
        </span>
    </div>
    
    @if ($table->hasExports() || $table->hasBulkActions())
        <div v-if="table.hasSelectedItems || @js($table->hasExports())" class="d-flex align-items-center justify-content-end" style="position: relative;">
            @include('splade::table.bulk-actions-exports')
        </div>
    @endif
</div>