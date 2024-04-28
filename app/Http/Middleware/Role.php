<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

use App\Models\Booking;
use App\Http\Controllers\BookingController;

class Role
{
    public function handle(Request $request, Closure $next, ...$roleIds)
    {
        $user = $request->user();

        // Check if user is logged in and has any of the specified role ids
        if (!$user || !in_array($user->role_id, $roleIds)) {
            abort(403, 'Unauthorized'); // Return a 403 Forbidden response if role doesn't match
        }

        return $next($request);
    }
}
