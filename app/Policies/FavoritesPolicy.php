<?php

namespace App\Policies;

use App\Favorites;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FavoritesPolicy {
    use HandlesAuthorization;

    /**
     * Determine whether the user can edit the favorites.
     *
     * @param \App\User $user
     * @param \App\Favorites $favorites
     * @return mixed
     */
    public function edit(User $user, Favorites $favorites) {
        return $user->id == $favorites->user_id;
    }
}
