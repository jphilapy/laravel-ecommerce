<?php

namespace Tests\Unit;

use App\Models\Budget\Budget;
use App\Models\Budget\Category;
use App\Models\Budget\Transaction;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class BudgetTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function it_has_a_balance()
    {
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create(['user_id'=>$user->id]);
        $transactions = factory(Transaction::class)->create(['category_id'=>$category->id,'user_id'=>$user->id], 3);
        $budget = factory(Budget::class)->create(['user_id'=>$user->id, 'category_id'=>$category->id]);

        $expectedBalance = $budget->amount - $transactions->sum('amount');

        $this->actingAs($user)->assertEquals($expectedBalance, $budget->balance());
    }
}
