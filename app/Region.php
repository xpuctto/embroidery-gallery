<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $guarded = [];

    public function embroideries()
    {
        return $this->hasMany(Embroidery::class);
    }

    public function cities() {
        return $this->hasMany(City::class);
    }
}
