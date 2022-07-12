<?php

namespace App\Models\Budget;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public $fillable = ['description', 'amount', 'category_id', 'user_id'];

    public static function boot() {
        parent::boot();

        static::addGlobalScope('user', function($query) {
            $query->where('user_id', auth()->id())->with('category');
        });

        // automatically save user id when creating new transaction
        static::saving(function($transaction){
            $transaction->user_id = $transaction->user_id ?: auth()->id();
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeByCategory($query, Category $category)
    {
        if($category->id) {
            $query->where('category_id', $category->id);
        }

    }

    public function scopeByMonth($query, $month = 'this month')
    {
        $query->where('created_at', '>=', Carbon::parse("first day of {$month}"))
        ->orWhere('created_at', '<=', Carbon::parse("last day of {$month}"));
    }
}
