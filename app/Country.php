<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {
    protected $guarded = [];

    public function rooms(){
        return $this->hasMany(Rooms::class);
    }

    public function cities() {
        return $this->hasMany(City::class);
    }
}
