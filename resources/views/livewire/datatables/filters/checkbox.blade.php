<div
    :title="$column['tooltip']['text'] ?? 'Select All'"
    class="text-center">
    <input
        wire:click="toggleSelectAll"
        type="checkbox"
        :checked="$this->results->total() === count($visibleSelected)"
        class="form-check-input"
    />
</div>