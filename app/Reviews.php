<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model {
    protected $guarded = [];

    public function room() {
        return $this->belongsTo(Rooms::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
