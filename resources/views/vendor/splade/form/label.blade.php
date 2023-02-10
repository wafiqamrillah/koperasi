<label {{ $attributes->only(['for', 'id']) }}>
    {{ $label }}
    
    @if ($required)
        <span class="text-danger">*</span>
    @endif
</label>