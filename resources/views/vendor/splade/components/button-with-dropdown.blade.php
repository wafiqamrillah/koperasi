<x-splade-toggle>
    <button type="button" {{ $attributes->class('btn btn-default btn-flat')->except(['dropdownClass']) }} data-toggle="dropdown" aria-expanded="false" @click.prevent="toggle" style="position: relative;">
        {{ $button }}
        

        <ul class="dropdown-menu" :class="{ 'show' : toggled }" @click.prevent="setToggle(false)" role="menu" aria-orientation="horizontal">
            {{ $slot }}
        </ul>
    </button>
</x-splade-toggle>
