<?php
namespace Database\Factories;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;


class CategoryFactory extends Factory
{
    public function definition()
    {
        $name = $this->faker->word;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'user_id' => function () {
                return User::factory()->create()->id;
            }
        ];
    }
}
