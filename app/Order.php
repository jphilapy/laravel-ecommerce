<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('price');
    }

    public function addProducts($products)
    {
        foreach($products as $product) {
            $this->products()->attach($product->id, ['price' => $product->price]);
        }
    }
}
