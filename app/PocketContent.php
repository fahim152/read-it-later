<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PocketContent extends Model
{
    protected $guarded = [];

    public function pocket()
    {
        return $this->belongsTo(Pocket::class);
    }
}
