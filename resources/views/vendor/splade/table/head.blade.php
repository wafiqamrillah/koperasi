<thead>
    <tr>
        @if($hasBulkActions = $table->hasBulkActions())
            <th class="text-center">
                @include('splade::table.select-rows-dropdown')
            </th>
        @endif

        @foreach($table->columns() as $column)
            <th
                v-show="table.columnIsVisible(@js($column->key))"
                class="text-left text-xs"
                style="padding-right: 1.5rem;{{ $loop->first && $hasBulkActions ? 'padding-left: 1.5rem;' : null }}padding-top: 0.75rem;padding-bottom: 0.75rem;font-weight: 500;letter-spacing: 0.025em;"
            >
                @if($column->sortable)
                <Link dusk="sort-{{ $column->key }}" href="{{ $sortBy($column) }}" class="text-body">
                @endif

                    <span style="display: flex; flex-director: row; align-items: center;">
                        <span style="text-transform: uppercase;">{{ $column->label }}</span>

                        @if($column->sortable)
                            <span style="padding-left: 1.5rem;">
                                @if(!$column->sorted)
                                    <i class="fa-solid fa-sort"></i>
                                @elseif($column->sorted === 'asc')
                                    <i class="fa-solid fa-sort-down"></i>
                                @elseif($column->sorted === 'desc')
                                    <i class="fa-solid fa-sort-asc"></i>
                                @endif
                            </span>
                        @endif
                    </span>

                @if($column->sortable)
                </Link>
                @endif
            </th>
        @endforeach
    </tr>
</thead>