<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $notification = auth()->user()?->notifications()->findOrFail($id);

            // Mark the notification as read
            $notification->markAsRead();

            // If the notification has a route or link, redirect to it
            if (isset($notification->data['route']) || isset($notification->data['link'])) {
                return $notification->data['route']
                    ? redirect()->route($notification->data['route']['name'], $notification->data['route']['params'] ?? [])
                    : redirect()->to($notification->data['link']);
            }
        } catch (\Exception $e) {
            // If the exception instance is an instance of ModelNotFoundException
            // then the notification does not exist
            if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect()->back()->with('error', 'The notification does not exist.');
            }

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
