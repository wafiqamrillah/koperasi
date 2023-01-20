<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\System\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Menu::truncate();
        Schema::enableForeignKeyConstraints();
        
        \DB::transaction(function() {
            $datas = $this->datas();

            $datas->map(function($data, $key) {
                return $this->buildData($data);
            });
            
            return $datas;
        });
    }

    // Datas
    protected function datas()
    {
        // parent_id
        // sort
        // label
        // link_type
        // link
        // icon_class
        // has_translation
        // is_active

        return collect([
            collect([
                'label' => 'Dashboard',
                'link_type' => 'route',
                'link' => 'dashboard.index',
                'icon_class' => 'fa-solid fa-fw fa-gauge',
                'has_translation' => true,
                'is_active' => true
            ]),
            collect([
                'label' => 'Master',
                'link_type' => 'url',
                'link' => '#',
                'icon_class' => 'fa-solid fa-fw fa-database',
                'has_translation' => false,
                'is_active' => true,
                'childs' => collect([
                    collect([
                        'label' => 'Member',
                        'link_type' => 'route',
                        'link' => 'master.members.index',
                        'icon_class' => 'fa-solid fa-fw fa-users',
                        'has_translation' => true,
                        'is_active' => true,
                    ])
                ])
            ]),
        ]);
    }

    protected function buildData($data, ?Menu $parent = NULL)
    {
        $menu = new Menu();

        if ($parent) {
            $menu->parent()->associate($parent);
        }

        $menu->sort = $data['sort'] ?? 0;
        $menu->label = $data['label'];
        $menu->link_type = $data['link_type'];
        $menu->link = $data['link'];
        $menu->icon_class = $data['icon_class'];
        $menu->has_translation = $data['has_translation'] ?? false;
        $menu->is_active = $data['is_active'] ?? false;

        $menu->save();

        $childs = $data['childs'] ?? collect([]);
        
        $childs->map(function($child) use($menu) {
            return $this->buildData($child, $menu);
        });

        $menu->load('childs');

        return $menu;
    }
}
