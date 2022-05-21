<?php

namespace Tests\Feature;

use App\Models\Budget\Category;
use App\Models\Budget\Transaction;
use App\User;
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

        $user = factory(User::class)->create();
        $category = factory(Category::class)->create(['user_id'=>$user->id]);
        $transaction = factory(Transaction::class)->create(['user_id'=>$user->id]);
        $newTransaction = factory(Transaction::class)->make(['user_id'=>$user->id, 'category_id'=>$category->id]);

        $this->actingAs($user)
            ->put("/budget/transactions/{$transaction->id}", $newTransaction->toArray())
        ;

        $this->get('/budget/transactions')
            ->assertSee($newTransaction->description);
    }

    /**
     * @test
     */
    public function it_cannot_update_transactions_without_a_description()
    {
        $user = factory(User::class)->create();
        $transaction = factory(Transaction::class)->create(['user_id'=>$user->id]);
        $newTransaction = factory(Transaction::class)->make(['description' => null]);

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
        $user = factory(User::class)->create();
        $transaction = factory(Transaction::class)->create(['user_id'=>$user->id]);
        $newTransaction = factory(Transaction::class)->make(['category_id' => null]);

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
        $user = factory(User::class)->create();
        $transaction = factory(Transaction::class)->create(['user_id'=>$user->id]);
        $newTransaction = factory(Transaction::class)->make(['amount' => null]);

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
        $user = factory(User::class)->create();
        $transaction = factory(Transaction::class)->create(['user_id'=>$user->id]);
        $newTransaction = factory(Transaction::class)->make(['amount' => 'abc']);

        $response = $this->actingAs($user)
            ->withExceptionHandling()
            ->put("/budget/transactions/{$transaction->id}", $newTransaction->toArray())
            ->assertSessionHasErrors('amount');
    }
}
