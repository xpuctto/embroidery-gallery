<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Symbol extends Model
{
    protected $guarded = [];

    public function embroidery()
    {
        return $this->belongsTo(Embroidery::class);
    }
}
