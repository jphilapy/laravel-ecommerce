<?php
namespace Database\Factories;

use App\Models\Budget\Category;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{

    public function definition()
    {
        return [
            'description' => $this->faker->sentence(2),
            'amount' => $this->faker->numberBetween(5,10),
            'category_id' => function () {
                return Category::factory()->create()->id;
            },
            'user_id' => function () {
                return User::factory()->create()->id;
            }
        ];
    }
}

