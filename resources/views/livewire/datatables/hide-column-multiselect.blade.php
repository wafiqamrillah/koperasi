<div x-data="{ show: false }" class="btn-group">
    <button
        type="button"
        x-on:click="show = !show"
        class="btn btn-default dropdown-toggle">
        {{ __('Show / Hide Columns') }}
    </button>
    <ul
        role="menu"
        x-cloak
        x-show="show"
        x-on:click.away="show = false"
        x-bind:class="{ 'show' : show }"
        x-bind:style="{ 'position: absolute; transform: translate3d(68px, 38px, 0px); top: 0px; left: 0px; will-change: transform;' : show }"
        class="dropdown-menu">
        @foreach ($this->columns as $index => $column)
            @if ($column['hideable'] !== false)
                <li>
                    <button wire:click.prevent="toggle({{ $index }})" type="button" class="dropdown-item">
                        <i class="fas {{ !$column['hidden'] ? 'fa-check text-success' : 'fa-times text-danger' }} text-sm"></i> {{ $column['label'] }}
                    </button>
                </li>
            @endif
        @endforeach
    </ul>
</div>
