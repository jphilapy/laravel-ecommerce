<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Video\Channel;
use Faker\Generator as Faker;

$factory->define(Channel::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'name' => $faker->name,
        'slug' => $faker->name,
        'uid' => 123,
    ];
});
