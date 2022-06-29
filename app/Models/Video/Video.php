<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'uid';
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
