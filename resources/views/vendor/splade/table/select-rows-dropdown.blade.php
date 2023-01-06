<x-splade-toggle>
    <div style="position: relative;">
        <input
            type="checkbox"
            :checked="table.allVisibleItemsAreSelected"
            @click.prevent="toggle"
        />
    
        <ul
            class="dropdown-menu"
            @click.prevent="setToggle(false)"
            :class="{ 'show' : toggled }">
            <a
                href="#"
                @click="table.setSelectedItems(@js($table->getPrimaryKeys()))"
                dusk="select-all-on-this-page">
                <li class="dropdown-item">
                    {{ __('Select all on this page') }} ({{ $table->totalOnThisPage() }})
                </li>
            </a>
    
            @if($showPaginator())
                <a
                    href="#"
                    @click="table.setSelectedItems(['*'])"
                    dusk="select-all-results">
                    <li class="dropdown-item">
                        {{ __('Select all results') }} ({{ $table->totalOnAllPages() }})
                    </li>
                </a>
            @endif
    
            <a
                href="#"
                v-if="table.hasSelectedItems"
                @click="table.setSelectedItems([])"
                dusk="select-none">
                <li class="dropdown-item">
                    {{ __('Clear selection') }}
                </li>
            </a>
        </ul>
    </div>
</x-splade-toggle>