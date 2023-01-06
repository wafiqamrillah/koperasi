<x-splade-toggle>
    <button v-if="table.hasSelectedItems" dusk="columns-dropdown" type="button" class="btn btn-default" data-toggle="dropdown" aria-expanded="false" @click.prevent="toggle" style="position: relative;">
        <i class="fa-solid fa-eye"></i>
        <i class="fa-solid fa-caret-down ml-2"></i>

        <div class="dropdown-menu dropdown-menu-right" :class="{ 'show' : toggled }" @click.prevent="setToggle(false)" role="menu" aria-orientation="horizontal">
            @foreach($table->columns() as $column)
                @if(!$column->canBeHidden)
                    @continue
                @endif
                <a
                    :aria-pressed="table.columnIsVisible(@js($column->key))"
                    aria-labelledby="toggle-column-{{ $column->key }}"
                    aria-describedby="toggle-column-{{ $column->key }}"
                    @click.prevent="table.toggleColumn(@js($column->key))"
                    dusk="toggle-column-{{ $column->key }}"
                    class="dropdown-item">
                    <i
                        class="fa-solid"
                        :class="{
                            'fa-check': table.columnIsVisible(@js($column->key)),
                            'fa-times': !table.columnIsVisible(@js($column->key)),
                        }"
                        ></i>
                    {{ $column->label }}
                </a>
            @endforeach
        </div>
    </button>
</x-splade-toggle>