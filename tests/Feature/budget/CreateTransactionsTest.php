<?php

namespace Tests\Feature\budget;

use App\Models\Budget\Category;
use App\Models\Budget\Transaction;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Tests\TestCase;

class CreateTransactionsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_can_create_transactions()
    {
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create(['user_id'=>$user->id]);
        $transaction = factory(Transaction::class)->make(['category_id'=>$category->id,'user_id'=>$user->id]);

//        $this->withoutExceptionHandling();
        $response = $this->actingAs($user)
            ->post('/budget/transactions', $transaction->toArray())
            ->assertRedirect('/budget/show-transactions');

<<<<<<< HEAD
        $this->get('/budget/show-transactions')
=======
        $this->actingAs($user)
            ->get('/budget/transactions')
>>>>>>> tdd-laravel-budget
            ->assertSee($transaction->description);
    }

    /**
     * @test
     */
    public function it_cannot_create_transactions_without_a_description()
    {
        $user = factory(User::class)->create();
        $transaction = factory(Transaction::class)->make(['description' => null]);

        $response = $this->actingAs($user)
            ->withExceptionHandling()
            ->post('/budget/transactions', $transaction->toArray())
            ->assertSessionHasErrors('description');
    }

    /**
     * @test
     */

    public function it_cannot_create_transactions_without_a_category()
    {
        $user = factory(User::class)->create();
        $transaction = factory(Transaction::class)->make(['category_id' => null]);

        $response = $this->actingAs($user)
            ->withExceptionHandling()
            ->post('/budget/transactions', $transaction->toArray())
            ->assertSessionHasErrors('category_id');
    }

    /**
     * @test
     */

    public function it_cannot_create_transactions_without_an_amount()
    {
        $user = factory(User::class)->create();
        $transaction = factory(Transaction::class)->make(['amount' => null]);

        $response = $this->actingAs($user)
            ->withExceptionHandling()
            ->post('/budget/transactions', $transaction->toArray())
            ->assertSessionHasErrors('amount');
    }

    /**
     * @test
     */

    public function it_cannot_create_transactions_without_a_numerical_amount()
    {
        $user = factory(User::class)->create();
        $transaction = factory(Transaction::class)->make(['amount' => 'abc']);

        $response = $this->actingAs($user)
            ->withExceptionHandling()
            ->post('/budget/transactions', $transaction->toArray())
            ->assertSessionHasErrors('amount');
    }
}
