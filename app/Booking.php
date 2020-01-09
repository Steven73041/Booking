<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model {
    protected $fillable = [
        'user_id', 'room_id', 'check_in_date', 'check_out_date'
    ];

    public function room() {
        return $this->belongsTo(Rooms::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
