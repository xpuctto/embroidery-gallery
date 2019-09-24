<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stitch extends Model
{
    protected $guarded = [];

    public function embroidery()
    {
        return $this->belongsToMany(Embroidery::class, 'embroidery_stitch');
    }
}
