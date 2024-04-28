<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
            // Define a view composer for all views
            View::composer('*', function ($view) {
                // Retrieve notifications for the authenticated user
                if (Auth::check()) {
                    $user = Auth::user();
                    $notifications = $user->unreadNotifications; // Adjust this based on your notification logic
                    $view->with('notifications', $notifications);
                }
            });
            }
}
