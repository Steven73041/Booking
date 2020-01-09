<?php

namespace App\Policies;

use App\Booking;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy {
    use HandlesAuthorization;
    /**
     * Determine whether the user can view the booking.
     *
     * @param \App\User $user
     * @param \App\Booking $booking
     * @return mixed
     */
    public function view(User $user, Booking $booking) {
        return $user->id == $booking->user_id;
    }
}
