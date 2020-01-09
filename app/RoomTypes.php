<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomTypes extends Model {

    protected $guarded = [];

    function rooms(){
        return $this->hasMany(Rooms::class, 'room_type', 'id');
    }

}
