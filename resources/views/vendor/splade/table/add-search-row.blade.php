<x-splade-component is="button-with-dropdown" dusk="add-search-row-dropdown">
    <x-slot:button>
        <i class="fa-solid fa-search"></i>
        <i class="ml-2 fa-solid fa-caret-down"></i>
    </x-slot:button>

    @foreach($table->searchInputs() as $searchInput)
        @if($searchInput->key === 'global')
            @continue
        @endif

        <a
            @click.prevent="table.showSearchInput(@js($searchInput->key));"
            dusk="add-search-row-{{ $searchInput->key }}">
            <li class="dropdown-item">
                {{ $searchInput->label }}
            </li>
        </a>
    @endforeach
</x-splade-component>