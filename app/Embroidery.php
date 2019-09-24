<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Embroidery extends Model
{
    protected $guarded = [];

    public function stitches()
    {
        return $this->belongsToMany(Stitch::class, 'embroidery_stitch');
    }

    public function symbols()
    {
        return $this->belongsToMany(Symbol::class, 'embroidery_symbol');
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class, 'embroidery_location');
    }

    public function embroidery_images()
    {
        return $this->hasMany(EmbroideryImage::class);
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
