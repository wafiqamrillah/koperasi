<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Storage;

use App\Models\System\Menu;

class Sidebar extends Component
{
    protected string $defaultLink = "#", $defaultIconClass = "fa-solid fa-fw fa-circle";
    protected bool $defaultHasTranslation = FALSE;

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
            ->filter(function($menu) {
                return $this->filterMenu($menu);
            })
            ->map(function($menu) {
                return $this->buildMenu($menu);
            });
    }

    protected function buildMenu($menu)
    {
        $menu = collect($menu);

        $link_type = isset($menu['link_type']) ? $menu['link_type'] : "url";
        $link = isset($menu['link']) ? $menu['link'] : "#";
        $has_translation = isset($menu['has_translation']) ? $menu['has_translation'] : $this->defaultHasTranslation; 

        $menu['childs'] = collect($menu['childs'])
            ->filter(function($child) {
                return $this->filterMenu($child);
            })
            ->map(function($child) {
                return $this->buildMenu($child);
            });

        $menu['link'] = $menu['childs']->count() > 0 ? $this->defaultLink : ($link_type === "route" && $link !== $this->defaultLink ? route($link) : $this->defaultLink);
        $menu['icon_class'] = isset($menu['icon_class']) ? $menu['icon_class'] : $this->defaultIconClass;
        $menu['label'] = isset($menu['label']) ? ($has_translation ? __($menu['label']) : $menu['label']) : "";

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
