<?php

namespace App\Models\Budget;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function getRouteKeyName()
    {
//        return parent::getRouteKeyName(); // TODO: Change the autogenerated stub
        return 'slug';
    }
}
