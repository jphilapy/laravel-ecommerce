<?php

namespace Tests\Feature\budget;

use App\Models\Budget\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTransactionsTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_can_create_transactions()
    {
        $transaction = make(Transaction::class);

        $this->post('/budget/transactions', $transaction->toArray())
        ->assertRedirect('/budget/transactions');

        $this->get('/budget/transactions')
            ->assertSee($transaction->description);
    }

    /**
     * @test
     */
    public function it_cannot_create_transactions_without_a_description()
    {

        $transaction = make(Transaction::class,['description' => null]);

        $resp = $this->withoutExceptionHandling()->post('/budget/transactions', $transaction->toArray())
            ->assertStatus(422);

//        ->assertSessionHasErrors('errors')

        /**
         *
         *
         *         $resp = $this->withoutExceptionHandling()->post('/budget/transactions', $transaction->toArray())
        ->assertStatus(422)
        ->assertJson([
        "message" => "The given data was invalid.",
        ]);

        /**
         * Add this if you add custom error message:
         *             "errors" => [
        "password" => ["The password confirmation does not match."]
        ]
         */

    }
}
