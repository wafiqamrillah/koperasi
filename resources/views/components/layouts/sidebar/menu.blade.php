<li class="nav-item">
    @if ($link !== "#")
    <Link href="{{ $link }}" class="nav-link">
    @else
    <a href="#" class="nav-link">
    @endif
        <i class="nav-icon {{ $icon_class }}"></i>
        <p>
            {{ $has_translation ? __($menu['label']) : $menu['label'] }}
            @if ($childs->count() > 0)
                <i class="right fa-solid fa-angle-left"></i>
            @endif
        </p>
    @if ($link !== "#")
    </Link>
    @else
    </a>
    @endif

    @if ($childs->count() > 0)
        <ul class="nav nav-treeview">
            @foreach($childs as $child)
                <x-layouts.sidebar.menu :menu="collect($child)" />
            @endforeach
        </ul>
    @endif
</li>