<?php

namespace App\Models\Budget;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $fillable = ['name', 'slug', 'user_id'];

    public static function boot() {
        parent::boot();

        static::addGlobalScope('user', function($query) {
            $query->where('user_id', auth()->id());
        });

        // automatically save user id when creating new transaction
        static::saving(function($category){
            $category->user_id = $category->user_id ?: auth()->id();
        });
    }

    public function getRouteKeyName()
    {
//        return parent::getRouteKeyName(); // TODO: Change the autogenerated stub
        return 'slug';
    }
}
