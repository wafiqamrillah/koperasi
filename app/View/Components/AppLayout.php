<?php

namespace App\View\Components;

use Illuminate\View\Component;
use ProtoneMedia\Splade\Components\PersistentComponent;

// Models
use App\Models\System\Setting;

class AppLayout extends PersistentComponent
{
    public ?string $application_logo = null, $application_name = null;

    public function __construct()
    {
        $this->application_logo = $this->getApplicationLogo();
        $this->application_name = $this->getApplicationName();
    }

    protected function getApplicationLogo()
    {
        return null;
    }

    protected function getApplicationName()
    {
        return null;
    }

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
