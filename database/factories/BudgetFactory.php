<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Budget\Budget;
use App\Models\Budget\Category;
use App\User;
use Faker\Generator as Faker;

$factory->define(Budget::class, function (Faker $faker) {
    return [
        'category_id' => function () {
            return factory(Category::class)->create()->id;
        },
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'amount'=>$faker->randomFloat(2,500, 1000),
        'budget_date'=>\Carbon\Carbon::now()->format('M')
    ];
});
