<nav role="navigation" aria-label="Pagination Navigation" class="tw-flex tw-justify-between tw-px-4 sm:tw-px-0 tw-py-3">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <span class="tw-relative tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-text-xs sm:tw-text-sm tw-font-medium tw-text-gray-500 tw-bg-white tw-border tw-border-gray-300 tw-cursor-default tw-leading-5 tw-rounded-md">
            {!! __('pagination.previous') !!}
        </span>
    @else
        <Link dusk="pagination-simple-previous" href="{{ $paginator->previousPageUrl() }}" rel="prev" class="tw-relative tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-text-xs sm:tw-text-sm tw-font-medium tw-text-gray-700 tw-bg-white tw-border tw-border-gray-300 leading-5 tw-rounded-md hover:tw-text-gray-500 focus:tw-outline-none focus:tw-ring tw-ring-gray-300 focus:tw-border-blue-300 active:tw-bg-gray-100 active:tw-text-gray-700 tw-transition tw-ease-in-out tw-duration-150">
            {!! __('pagination.previous') !!}
        </Link>
    @endif

    @includeWhen($hasPerPageOptions ?? true, 'splade::table.per-page-selector')

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <Link dusk="pagination-simple-next" href="{{ $paginator->nextPageUrl() }}" rel="next" class="tw-relative tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-text-xs sm:tw-text-sm tw-font-medium tw-text-gray-700 tw-bg-white tw-border tw-border-gray-300 tw-leading-5 tw-rounded-md hover:tw-text-gray-500 focus:tw-outline-none focus:tw-ring tw-ring-gray-300 focus:tw-border-blue-300 active:tw-bg-gray-100 active:tw-text-gray-700 tw-transition tw-ease-in-out tw-duration-150">
            {!! __('pagination.next') !!}
        </Link>
    @else
        <span class="tw-relative tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-text-xs sm:tw-text-sm tw-font-medium tw-text-gray-500 tw-bg-white tw-border tw-border-gray-300 tw-cursor-default tw-leading-5 tw-rounded-md">
            {!! __('pagination.next') !!}
        </span>
    @endif
</nav>
