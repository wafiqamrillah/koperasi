<?php

namespace App\View\Components\Layouts\Sidebar;

use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

class Menu extends Component
{
    public Collection|array $childs = [];
    public string $link = "#";
    public string $icon_class = "fa-solid fa-circle";
    public bool $has_translation = FALSE;
    public string $label = "Menu";

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public EloquentCollection|Collection|array $menu = [])
    {
        $link_type = isset($menu['link_type']) ? $menu['link_type'] : "url";
        $link = isset($menu['link']) ? $menu['link'] : "#";

        $this->childs = isset($menu['childs']) ? collect($menu['childs']) : collect($this->childs);
        $this->link = $this->childs->count() > 0 ? $this->link : ($link_type === "route" && $link !== $this->link ? route($link) : $link);
        $this->icon_class = isset($menu['icon_class']) ? $menu['icon_class'] : $this->icon_class;
        $this->has_translation = isset($menu['has_translation']) ? $menu['has_translation'] : $this->has_translation;
        $this->label = isset($menu['label']) ? $menu['label'] : $this->label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.sidebar.menu');
    }
}
