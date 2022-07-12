<?php
namespace Database\Factories;

use App\Models\Budget\Category;
use App\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class BudgetFactory extends Factory
{
    public function definition()
    {
        return [
            'category_id' => function () {
                return Category::factory()->create()->id;
            },
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'amount'=>$this->faker->randomFloat(2,500, 1000),
            'budget_date'=>\Carbon\Carbon::now()->format('M')
        ];
    }
}
