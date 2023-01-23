<?php

namespace App\View\Components\Layouts\Sidebar;

use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

class Menu extends Component
{
    public Collection|array $childs = [];
    public string $link = "#";
    public string $icon_class = "fa-solid fa-fw fa-circle";
    public bool $has_translation = FALSE;
    public string $label = "Menu";

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public EloquentCollection|Collection|array $menu = [])
    {
        $this->childs = $menu['childs'];
        $this->link = $menu['link'];
        $this->icon_class = $menu['icon_class'];
        $this->has_translation = $menu['has_translation'];
        $this->label = $menu['label'];
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
