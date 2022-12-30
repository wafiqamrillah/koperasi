<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Storage;

use App\Models\System\Menu;

class Sidebar extends Component
{
    public function __construct(
        public \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|array $menus = [],
        public ?string $application_logo = null,
        public ?string $application_name = null
    )
    {
        $this->menus = $menus ? $menus : $this->generateMenu();
        $this->application_logo = $application_logo ? $application_logo : $this->getApplicationLogo();
        $this->application_name = $application_name ? $application_name : $this->getApplicationName();
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

    protected function getApplicationLogo()
    {
        return config('app.logo') ? Storage::disk('public')->url(config('app.logo')) : null;
    }

    protected function getApplicationName()
    {
        return config('app.name', 'Laravel');
    }

    public function render()
    {
        return view('components.layouts.sidebar');
    }
}
