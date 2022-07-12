<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class ChannelFactory extends Factory
{
    public function definition()
    {
        $name = $this->faker->name;
        return [
            'user_id' => 1,
            'name' => $name,
            'slug' => Str::slug($name),
            'uid' => 123,
        ];
    }
}
