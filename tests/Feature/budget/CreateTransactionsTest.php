<?php

namespace Tests\Feature\budget;

use App\Models\Budget\Transaction;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $transaction = factory(Transaction::class)->make();

        $this->withoutExceptionHandling();
        $response = $this->actingAs($user)
            ->post('/budget/transactions', $transaction->toArray())
            ->assertRedirect('/budget/transactions');

        $this->get('/budget/transactions')
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
