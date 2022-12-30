<thead class="tw-bg-gray-50">
    <tr>
        @if($hasBulkActions = $table->hasBulkActions())
            <th width="64" class="tw-px-6 tw-py-3 tw-text-xs">
                @include('splade::table.select-rows-dropdown')
            </th>
        @endif

        @foreach($table->columns() as $column)
            <th
                v-show="table.columnIsVisible(@js($column->key))"
                class="@if($loop->first && $hasBulkActions) tw-pr-6 @else tw-px-6 @endif tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-tracking-wide tw-text-gray-500"
            >
                @if($column->sortable)
                    <Link dusk="sort-{{ $column->key }}" href="{{ $sortBy($column) }}">
                @endif

                <span class="tw-flex tw-flex-row tw-items-center">
                    <span class="tw-uppercase">{{ $column->label }}</span>

                    @if($column->sortable)
                        <svg aria-hidden="true" class="tw-w-3 tw-h-3 tw-ml-2 {{ $column->sorted ? 'tw-text-green-500' : 'tw-text-gray-400' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                            @if(!$column->sorted)
                                <path fill="currentColor" d="M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41zm255-105L177 64c-9.4-9.4-24.6-9.4-33.9 0L24 183c-15.1 15.1-4.4 41 17 41h238c21.4 0 32.1-25.9 17-41z" />
                            @elseif($column->sorted === 'asc')
                                <path fill="currentColor" d="M279 224H41c-21.4 0-32.1-25.9-17-41L143 64c9.4-9.4 24.6-9.4 33.9 0l119 119c15.2 15.1 4.5 41-16.9 41z" />
                            @elseif($column->sorted === 'desc')
                                <path fill="currentColor" d="M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41z" />
                            @endif
                        </svg>
                    @endif
                </span>

                @if($column->sortable)
                    </Link>
                @endif
            </th>
        @endforeach
    </tr>
</thead>