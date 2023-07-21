<ul class="pagination">
    <!-- Previous Page Link -->
    @if ($paginator->onFirstPage())
    <li class="page-item disabled"
        disabled>
        <a href="#" tabindex="0" class="page-link">&laquo;</a>
    </li>
    @else
    <li wire:click="previousPage"
        id="pagination-desktop-page-previous"
        class="page-item">
        <a href="#" tabindex="0" class="page-link">&laquo;</a>
    </li>
    @endif

    @foreach ($elements as $element)
        @if (is_string($element))
            <li class="page-item disabled" disabled>
                <a href="#" tabindex="0" class="page-link">{{ $element }}</a>
            </li>
        @endif

        <!-- Array Of Links -->

        @if (is_array($element))
            @foreach ($element as $page => $url)
                <li 
                    @if($page === $paginator->currentPage()) disabled @else wire:click="gotoPage({{ $page }})" @endif
                    id="pagination-desktop-page-{{ $page }}"
                    class="page-item {{ $page === $paginator->currentPage() ? 'disabled' : '' }}">
                    <a href="#" tabindex="0" class="page-link">{{ $page }}</a>
                </li>
            @endforeach
        @endif
    @endforeach
    

    <!-- Next Page Link -->
    @if ($paginator->hasMorePages())
    <li wire:click="nextPage"
        id="pagination-desktop-page-next"
        class="page-item">
        <a href="#" tabindex="0" class="page-link">&raquo;</a>
    </li>
    @else
    <li class="page-item disabled"
        disabled>
        <a href="#" tabindex="0" class="page-link">&raquo;</a>
    </li>
    @endif
</ul>
