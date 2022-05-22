<?php

namespace Tests\Feature\budget;

use App\Models\Budget\Budget;
use App\Models\Budget\Category;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateBudgetsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function it_can_create_budgets()
    {
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create(['user_id'=>$user->id]);
        $budget = factory(Budget::class)->make(['category_id'=>$category->id,'user_id'=>$user->id]);

        $this->withoutExceptionHandling();
        $response = $this->actingAs($user)
            ->post('/budget/budgets', $budget->toArray())
            ->assertRedirect('/budget/budgets');

        $this->actingAs($user)
            ->get('/budget/budgets')
            ->assertSee((string)$budget->amount);
    }
}
