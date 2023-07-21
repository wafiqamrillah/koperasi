<div x-data="{
    edit: false,
    edited: false,
    init() {
        window.livewire.on('fieldEdited', (id, column) => {
            if (id === '{{ $rowId }}' && column === '{{ $column }}') {
                this.edited = true
                setTimeout(() => {
                    this.edited = false
                }, 5000)
            }
        })
    }
}" x-init="init()" wire:key="{{ $rowId }}_{{ $column }}">
    <span
        x-show="!edit"
        x-on:click="edit = true; $nextTick(() => { $refs.input.focus() })">
        {!! htmlspecialchars($value) !!}
    </span>
    <span x-cloak x-show="edit">
        <input
            x-ref="input"
            wire:change="edited($event.target.value, '{{ $key }}', '{{ $column }}', '{{ $rowId }}')"
            x-on:click.away="edit = false"
            x-on:blur="edit = false"
            x-on:keydown.enter="edit = false"
            value="{!! htmlspecialchars($value) !!}"
            class="form-control text-sm" />
    </span>
</div>
