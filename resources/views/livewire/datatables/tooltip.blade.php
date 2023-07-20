<span
    data-toggle="tooltip"
    data-html="true"
    title="{!! $slot !!}"
    class="text-center">
    {{ Str::limit($slot, $length) }}
</span>