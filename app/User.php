<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable {
    use Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName', 'email', 'password', 'city', 'phone', 'age',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'role'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function photos() {
        return $this->hasMany(Photos::class);
    }

    public function reviews() {
        return $this->hasMany(Reviews::class);
    }

    public function rooms() {
        return $this->hasMany(Rooms::class);
    }

    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function favorites() {
        return $this->hasMany(Favorites::class);
    }

    public function owns($room) {
        return auth()->user()->id == $room->user_id;
    }
}
