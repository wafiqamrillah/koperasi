<button {{ $attributes->class(
    'btn btn-primary disabled:opacity-50'
)->merge([
    'type' => $type,
    ':class' => "{ 'loading' : $spinner && form.processing }"
])->when($name, fn($attr) => $attr->merge([
    'name' => $name,
    'value' => $value
])) }}
>
    @if(trim($slot))
        {{ $slot }}
    @else
        <span :class="{ 'opacity-50': form.processing || form.$uploading }">
            {{ $label }}
        </span>
    @endif
</button>