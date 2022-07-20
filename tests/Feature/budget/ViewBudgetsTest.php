<?php

namespace Tests\Feature\budget;

use App\Models\Budget\Budget;
use App\Models\Budget\Category;
use App\Models\Video\Channel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewBudgetsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_allows_only_authenticated_users_to_the_budgets_list()
    {
        $this->get('/budget/budgets')
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function it_should_display_budgets_for_the_current_month_by_default()
    {
        $user = User::factory()->create();
        Channel::factory()->create(['user_id'=>$user->id]);
        $category = Category::factory()->create(['user_id'=>$user->id]);
        $budgetForThisMonth = Budget::factory()->create(['user_id'=>$user->id, 'category_id'=>$category->id]);
        $budgetForLastMonth = Budget::factory()->create(['user_id'=>$user->id, 'category_id'=>$category->id, 'budget_date'=>Carbon::now()->subMonth(1)]);

        $this->actingAs($user)
            ->withoutExceptionHandling()
            ->get('/budget/budgets')
            ->assertSee((string) $budgetForThisMonth->amount)
            ->assertSee((string) $budgetForThisMonth->balance())
            ->assertDontSee((string) $budgetForLastMonth->amount)
            ->assertDontSee((string) $budgetForLastMonth->balance());
    }
}
