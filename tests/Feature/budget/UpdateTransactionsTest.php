<?php

namespace Tests\Feature\budget;

use App\Models\Budget\Category;
use App\Models\Budget\Transaction;
use App\Models\User;
use App\Models\Video\Channel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UpdateTransactionsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_can_update_transactions()
    {
//        $this->withOutExceptionHandling();

        $user = User::factory()->create();
        Channel::factory()->create(['user_id'=>$user->id]);
        $category = Category::factory()->create(['user_id'=>$user->id]);
        $transaction = Transaction::factory()->create(['user_id'=>$user->id]);
        $newTransaction = Transaction::factory()->make(['user_id'=>$user->id, 'category_id'=>$category->id]);

        $this->actingAs($user)
            ->put("/budget/transactions/{$transaction->id}", $newTransaction->toArray())
        ;

        $this->actingAs($user)->get('/budget/transactions')
            ->assertSee($newTransaction->name);
    }

    /**
     * @test
     */
    public function it_cannot_update_transactions_without_a_description()
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create(['user_id'=>$user->id]);
        $newTransaction = Transaction::factory()->make(['description' => null]);

        $response = $this->actingAs($user)
            ->withExceptionHandling()
            ->put("/budget/transactions/{$transaction->id}", $newTransaction->toArray())
            ->assertSessionHasErrors('description');
    }

    /**
     * @test
     */

    public function it_cannot_update_transactions_without_a_category()
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create(['user_id'=>$user->id]);
        $newTransaction = Transaction::factory()->make(['category_id' => null]);

        $response = $this->actingAs($user)
            ->withExceptionHandling()
            ->put("/budget/transactions/{$transaction->id}", $newTransaction->toArray())
            ->assertSessionHasErrors('category_id');
    }

    /**
     * @test
     */

    public function it_cannot_update_transactions_without_an_amount()
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create(['user_id'=>$user->id]);
        $newTransaction = Transaction::factory()->make(['amount' => null]);

        $response = $this->actingAs($user)
            ->withExceptionHandling()
            ->put("/budget/transactions/{$transaction->id}", $newTransaction->toArray())
            ->assertSessionHasErrors('amount');
    }

    /**
     * @test
     */

    public function it_cannot_update_transactions_without_a_numerical_amount()
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create(['user_id'=>$user->id]);
        $newTransaction = Transaction::factory()->make(['amount' => 'abc']);

        $response = $this->actingAs($user)
            ->withExceptionHandling()
            ->put("/budget/transactions/{$transaction->id}", $newTransaction->toArray())
            ->assertSessionHasErrors('amount');
    }
}
