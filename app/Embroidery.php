<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Embroidery extends Model
{
    protected $guarded = [];

    public function stitches()
    {
        return $this->hasMany(Stitch::class);
    }

    public function symbols()
    {
        return $this->hasMany(Symbol::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
