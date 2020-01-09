<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorites extends Model {
    protected $guarded = [];
    protected $hidden = ['id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function room() {
        return $this->belongsTo(Rooms::class);
    }
}
