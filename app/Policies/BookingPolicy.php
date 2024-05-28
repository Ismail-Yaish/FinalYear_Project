<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can edit the booking.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Booking  $booking
    //  * @return mixed
     * @return bool
     */
    public function edit(User $user, Booking $booking)
    {
        // return $user->id === $booking->seeker_id;
        return $user->id === $booking->seeker_id || $user->hasRole('admin');
    }


    // ADMIN DASHBOARD - BREAD FIX

    /**
     * Determine whether the user can browse bookings.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function browse(User $user)
    {
        // Define your logic for authorization. For example:
        return $user->hasRole('admin'); // or any other condition
    }


    /**
     * Determine whether the user can view a booking.
     */
    // public function view(User $user, Booking $booking)
    // {
    //     return $user->id === $booking->seeker_id || $user->hasRole('admin');
    // }

    /**
     * Determine whether the user can read a booking.
     */
    public function read(User $user, Booking $booking)
    {
        return $user->id === $booking->seeker_id || $user->hasRole('admin');
    }

  

    /**
     * Determine whether the user can create bookings.
     */
    public function create(User $user)
    {
        return $user->hasRole('admin') || $user->hasRole('seeker');
    }

    /**
     * Determine whether the user can update the booking.
     */
    public function update(User $user, Booking $booking)
    {
        return $user->id === $booking->seeker_id || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the booking.
     */
    public function delete(User $user, Booking $booking)
    {
        return $user->hasRole('admin');
    }
}

























































// namespace App\Policies;

// use App\Models\Booking;
// use App\Models\User;
// use Illuminate\Auth\Access\Response;

// class BookingPolicy
// {
//     /**
//      * Determine whether the user can view any models.
//      */
//     public function viewAny(User $user): bool
//     {
//         //
//     }

//     /**
//      * Determine whether the user can view the model.
//      */
//     public function view(User $user, Booking $booking): bool
//     {
//         //
//     }

//     /**
//      * Determine whether the user can create models.
//      */
//     public function create(User $user): bool
//     {
//         //
//     }

//     /**
//      * Determine whether the user can update the model.
//      */
//     public function update(User $user, Booking $booking): bool
//     {
//         //
//     }

//     /**
//      * Determine whether the user can delete the model.
//      */
//     public function delete(User $user, Booking $booking): bool
//     {
//         //
//     }

//     /**
//      * Determine whether the user can restore the model.
//      */
//     public function restore(User $user, Booking $booking): bool
//     {
//         //
//     }

//     /**
//      * Determine whether the user can permanently delete the model.
//      */
//     public function forceDelete(User $user, Booking $booking): bool
//     {
//         //
//     }
// }
