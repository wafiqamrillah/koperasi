<li class="nav-item">
    <Link href="{{ $link }}" class="nav-link">
        <i class="nav-icon {{ $icon_class }}"></i>
        <p>
            {{ $has_translation ? __($menu['label']) : $menu['label'] }}
            @if ($childs->count() > 0)
                <i class="right fa-solid fa-angle-left"></i>
            @endif
        </p>
    </Link>

    @if ($childs->count() > 0)
        <ul class="nav nav-treeview">
            @foreach($childs as $child)
                <x-layouts.sidebar.menu :menu="collect($child)" />
            @endforeach
        </ul>
    @endif
</li>