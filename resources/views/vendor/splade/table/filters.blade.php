<x-splade-toggle dusk="filters-dropdown">
    <button type="button" class="btn btn-default btn-flat" data-toggle="dropdown" aria-expanded="false" @click.prevent="toggle" style="position: relative;">
        <i class="fa-solid fa-filter"></i>
        <i class="fa-solid fa-caret-down ml-2"></i>

        <ul class="dropdown-menu dropdown-menu-lg" :class="{ 'show' : toggled }" role="menu" aria-orientation="horizontal" aria-labelledby="filter-menu">
            @foreach($table->filters() as $filter)
                <li class="dropdown-header">
                    {{ $filter->label }}
                </li>
                
                @if($filter->type === 'select')
                    <select
                        name="filter-{{ $filter->key }}"
                        class="form-control form-control-sm"
                        @change="table.updateQuery('filter[{{ $filter->key }}]', $event.target.value)"
                    >
                        @foreach($filter->options() as $optionKey => $option)
                            <option @selected($filter->hasValue() && $filter->value == $optionKey) value="{{ $optionKey }}">
                                {{ $option }}
                            </option>
                        @endforeach
                    </select>
                @endif
            @endforeach
        </ul>
    </button>
</x-splade-toggle>