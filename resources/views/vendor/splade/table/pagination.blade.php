<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="d-flex align-items-center justify-content-between">
    <div class="d-flex justify-content-between align-items-center d-md-none" style="flex: 1 1 0%;">
        @if ($paginator->onFirstPage())
            <button class="btn btn-default">
                {!! __('pagination.previous') !!}
            </button>
        @else
            <Link dusk="pagination-simple-previous" href="{{ $paginator->previousPageUrl() }}">
                <button class="btn btn-default">
                    {!! __('pagination.previous') !!}
                </button>
            </Link>
        @endif

        @includeWhen($hasPerPageOptions ?? true, 'splade::table.per-page-selector')

        @if ($paginator->hasMorePages())
            <Link dusk="pagination-simple-next" href="{{ $paginator->nextPageUrl() }}">
                <button class="btn btn-default">
                    {!! __('pagination.next') !!}
                </button>
            </Link>
        @else
            <button class="btn btn-default">
                {!! __('pagination.next') !!}
            </button>
        @endif
    </div>

    <div class="d-none d-md-flex align-items-center justify-content-between" style="flex: 1 1 0%;">
        <div class="d-flex align-items-center">
            @includeWhen($hasPerPageOptions ?? true, 'splade::table.per-page-selector')

            <div class="d-none d-lg-block @if($hasPerPageOptions ?? true) ml-3 @endif">
                <span class="text-nowrap text-xs">
                    @if ($paginator->firstItem())
                        <span class="font-weight-bold">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-weight-bold">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-weight-bold">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </span>
            </div>
        </div>

        <div>
            <ul class="pagination pagination-sm m-0">
                {{-- Previous Page Link --}}
                <li class="page-item">
                    @if ($paginator->onFirstPage())
                        <a class="page-link" href="#" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            &laquo;
                        </a>
                    @else
                        <Link class="page-link" dusk="pagination-previous" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-disabled="false" aria-label="{{ __('pagination.previous') }}">
                            &laquo;
                        </Link>
                    @endif
                </li>

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item">
                            <a class="page-link" href="#" aria-disabled="true">
                                {{ $element }}
                            </a>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                                @if ($page == $paginator->currentPage())
                                    <a class="page-link" href="#" aria-current="page" aria-disabled="true">
                                        {{ $page }}
                                    </a>
                                @else
                                    <Link class="page-link" dusk="pagination-{{ $page }}" href="{{ $url }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </Link>
                                @endif
                            </li>
                        @endforeach
                    @endif
                @endforeach
                
                {{-- Next Page Link --}}
                <li class="page-item">
                @if ($paginator->onLastPage())
                    <a class="page-link" href="#" aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                        &raquo;
                    </a>
                @else
                    <Link class="page-link" dusk="pagination-next" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-disabled="false" aria-label="{{ __('pagination.next') }}">
                        &raquo;
                    </Link>
                @endif
                </li>
            </ul>
        </div>
    </div>
</nav>