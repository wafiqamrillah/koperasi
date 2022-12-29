<?php

namespace App\View\Components;

use Illuminate\View\Component;
use ProtoneMedia\Splade\Components\PersistentComponent;

class AppLayout extends PersistentComponent
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.app');
    }
}
