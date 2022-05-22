<?php

namespace App\Models\Video;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public $fillable = ['name','slug','uid','description','image'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
