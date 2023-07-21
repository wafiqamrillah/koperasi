<div class="btn-group">
    <!-- Previous Page Link -->
    @if ($paginator->onFirstPage())
    <button type="button" class="btn btn-default" disabled>
        <i class="fas fa-arrow-left text-sm"></i>
        {{ __('Previous')}}
    </button>
    @else
    <button wire:click="previousPage" id="pagination-mobile-page-previous" type="button" class="btn btn-default">
        <i class="fas fa-arrow-left text-sm"></i>
        {{ __('Previous')}}
    </button>
    @endif
    
    <!-- Next Page link -->
    @if ($paginator->hasMorePages())
    <button wire:click="nextPage" id="pagination-mobile-page-next" type="button" class="btn btn-default">
        {{ __('Next')}}
        <i class="fas fa-arrow-right text-sm"></i>
    </button>
    @else
    <button type="button" class="btn btn-default" disabled>
        {{ __('Next')}}
        <i class="fas fa-arrow-right text-sm"></i>
    </button>
    @endif
</div>