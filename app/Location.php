<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $guarded = [];

    public function embroideries()
    {
        return $this->belongsToMany(Embroidery::class, 'embroidery_location');
    }
}
