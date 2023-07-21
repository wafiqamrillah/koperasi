@unless($column['hidden'])
    <th
        @if($column['sortable']) wire:click="sort('{{ $index }}')" @endif
        @if (isset($column['tooltip']['text'])) title="{{ $column['tooltip']['text'] }}" @endif
        @include('datatables::style-width')
        class="{{ $column['headerAlign'] === 'right' ? 'text-right' : (($column['headerAlign'] === 'center') ? 'text-center' : '') }}"
        style="cursor: {{ $column['sortable'] ? 'pointer' : 'default' }};"
        >
        <span>{{ str_replace('_', ' ', $column['label']) }}</span>
        @if($column['sortable'])
            <span>
                @if($sort === $index)
                    @if($direction)
                        <i class="fas fa-chevron-up text-xs"></i>
                    @else
                        <i class="fas fa-chevron-down text-xs"></i>
                    @endif
                @endif
            </span>
        @endif
    </th>
@endif
