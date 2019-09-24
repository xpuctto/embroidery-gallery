<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmbroideryImage extends Model
{
    protected $guarded = [];

    public function embroideries()
    {
        return $this->belongsTo(Embroidery::class);
    }
}
