<?php

namespace Tests\Feature\budget;

use App\Models\Budget\Category;
use App\Models\Budget\Transaction;
use App\Models\User;
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
        $user = User::factory()->create();
        $category = Category::factory()->create(['user_id'=>$user->id]);
        $transaction = Transaction::factory()->make(['category_id'=>$category->id,'user_id'=>$user->id]);

//        $this->withoutExceptionHandling();
        $response = $this->actingAs($user)
            ->post('/budget/transactions', $transaction->toArray())
            ->assertRedirect('/budget/transactions');

        $this->actingAs($user)
            ->get('/budget/transactions')
            ->assertSee($transaction->description);
    }

    /**
     * @test
     */
    public function it_cannot_create_transactions_without_a_description()
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->make(['description' => null]);

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
        $user = User::factory()->create();
        $transaction = Transaction::factory()->make(['category_id' => null]);

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
        $user = User::factory()->create();
        $transaction = Transaction::factory()->make(['amount' => null]);

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
        $user = User::factory()->create();
        $transaction = Transaction::factory()->make(['amount' => 'abc']);

        $response = $this->actingAs($user)
            ->withExceptionHandling()
            ->post('/budget/transactions', $transaction->toArray())
            ->assertSessionHasErrors('amount');
    }
}
