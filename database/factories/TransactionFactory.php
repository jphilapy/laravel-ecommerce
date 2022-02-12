<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Budget\Transaction;
use App\Models\Budget\Category;
use App\User;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence(2),
        'category_id' => function () {
            return factory(Category::class)->create()->id;
        },
        'user_id' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});
