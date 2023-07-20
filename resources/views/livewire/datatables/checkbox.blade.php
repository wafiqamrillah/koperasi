<div class="form-check">
    <input
        type="checkbox"
        wire:model="selected"
        value="{{ $value }}"
        :checked="property_exists($this, 'pinnedRecords') && in_array($value, $this->pinnedRecords)"
        class="form-check-input"
    />
</div>
