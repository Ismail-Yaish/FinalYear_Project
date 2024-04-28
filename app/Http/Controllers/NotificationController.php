<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    # SEEKER NOTIFICAITONS
    public function seekerMarkAllNotificationAsRead()
    {

        auth()->user()->unreadNotifications->markAsRead();
        
        return redirect()->back()->with('success', 'All Notifications are marked as Read!');
    }

    public function seekerMarkIndividualNotificationAsRead($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if ($notification) {
            $notification->markAsRead();
            return redirect(route('seeker.my-bookings'));
        } else {
            return redirect()->back()->with('error', 'Notification not found!');
        }
    }

    # POSTER NOTIFICAITONS

    public function posterMarkAllNotificationAsRead()
    {

        auth()->user()->unreadNotifications->markAsRead();
        
        return redirect()->back()->with('success', 'All Notifications are marked as Read!');
    }

    public function posterMarkIndividualNotificationAsRead($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if ($notification) {
            $notification->markAsRead();
            return redirect(route('posts.poster-bookings'));
        } else {
            return redirect()->back()->with('error', 'Notification not found!');
        }
    }

    
}
