<?php

namespace App\Http\Livewire\System\NavigationBar;

use Livewire\Component;

class NotificationMenu extends Component
{
    protected $listeners = [
        'loadNotifications',
        'refreshNotifications',
    ];

    public $loaded = false;
    public $notifications = [];

    public function loadNotifications() : void
    {
        $this->loaded = true;

        $this->notifications = auth()->user()?->unreadNotifications
            ->filter(fn ($notification) => isset($notification['data']['route']) || isset($notification['data']['link']))
            ->map(function ($notification) {
                $notification['human_readable_created_at'] = $notification['created_at']->diffForHumans();

                return $notification;
            })
            ->toArray();
    }

    public function refreshNotifications() : void
    {
        $this->loaded = false;

        $this->loadNotifications();
    }

    public function render()
    {
        return view('livewire.system.navigation-bar.notification-menu');
    }
}
