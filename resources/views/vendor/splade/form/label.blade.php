<label {{ $attributes->only(['for', 'id']) }}>
    {{ $label }}
    
    @isset ($required)
        @if($required)<span class="text-danger">*</span>@endif
    @endif
</label>