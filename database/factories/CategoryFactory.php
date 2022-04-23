<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Budget\Category;
use App\User;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $name = $faker->word;
    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'user_id' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});
