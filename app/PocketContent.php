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

    public function getCreatedAt()
    {
        return date("d-m-Y h:i", strtotime($this->created_at));
    }
}
