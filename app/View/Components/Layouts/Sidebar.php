<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

use App\Models\System\Menu;

class Sidebar extends Component
{
    public function __construct(public \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|array $menus = [])
    {
        $this->menus = $menus ? $menus : $this->generateMenu();
    }

    protected function generateMenu()
    {
        return Menu::with(['childs' => function($query) {
                return $query
                    ->active()
                    ->orderBy('sort', 'asc');
            }])
            ->active()
            ->mainMenu()
            ->orderBy('sort', 'asc')
            ->get()
            ->map(function($menu) {
                return $this->buildMenu($menu);
            })
            ->filter(function($menu) {
                return $this->filterMenu($menu);
            });
    }

    protected function buildMenu($menu)
    {
        $menu->childs = $menu->childs->filter(function($child) {
            return $this->filterMenu($child);
        });

        return $menu;
    }

    protected function filterMenu($menu)
    {
        return $menu;
    }

    public function render()
    {
        return view('components.layouts.sidebar');
    }
}
