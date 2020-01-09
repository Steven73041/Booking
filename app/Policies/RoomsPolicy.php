<?php

namespace App\Policies;

use App\Rooms;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoomsPolicy {
    use HandlesAuthorization;

    /**
     * Determine whether the user can edit the rooms.
     *
     * @param \App\User $user
     * @param \App\Rooms $rooms
     * @return mixed
     */
    public function edit(User $user, Rooms $rooms) {
        return $user->id == $rooms->user_id;
    }

}
