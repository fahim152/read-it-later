<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pocket extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contents()
    {
        return $this->hasMany(PocketContent::class);
    }
}
