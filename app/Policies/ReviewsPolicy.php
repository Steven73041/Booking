<?php

namespace App\Policies;

use App\Rooms;
use App\Reviews;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewsPolicy {
    use HandlesAuthorization;

    /**
     * Determine whether the user can edit the reviews.
     *
     * @param \App\User $user
     * @param \App\Reviews $reviews
     * @return mixed
     */

    public function delete(User $user, Reviews $reviews) {
        return $user->id == $reviews->user_id || $user->id == $reviews->room->user_id;
    }

    /**
     * Determine whether the user can edit the reviews.
     *
     * @param \App\User $user
     * @param \App\Reviews $reviews
     * @return mixed
     */
    public function edit(User $user, Reviews $reviews) {
        return $user->id == $reviews->user_id;
    }
}
