<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;

class GetNotificationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view(
            'system.notifications.dropdown-notifications',
            [
                'totalUnreadNotifications' => Splade::onLazy(fn() => $request->user()->unreadNotifications()->count()),
                'unreadNotifications' => Splade::onLazy(fn() => $request->user()->unreadNotifications)
            ]
        );
    }
}
