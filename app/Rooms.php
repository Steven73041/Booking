<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Rooms extends Model {
    use Sluggable;
    use SluggableScopeHelpers;
    protected $guarded = [];
    protected $hidden = [];

    public function type() {
        return $this->belongsTo(RoomTypes::class, 'room_type', 'id');
    }

    public function favorites() {
        return $this->hasMany(Favorites::class, 'room_id', 'id');
    }

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function photos() {
        return $this->hasMany(Photos::class, 'room_id', 'id');
    }

    public function reviews() {
        return $this->hasMany(Reviews::class, 'room_id', 'id');
    }

    public function bookings() {
        return $this->hasMany(Booking::class, 'room_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function sluggable(){
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(){
        return 'slug';
    }
}
