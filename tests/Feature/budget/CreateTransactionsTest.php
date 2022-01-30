<?php

namespace Tests\Feature\budget;

use App\Models\Budget\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class CreateTransactionsTest extends TestCase
{
    use RefreshDatabase;

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

        $transaction = factory(Transaction::class)->make(['description' => null]);

        $resp = $this->withoutExceptionHandling()->post('/budget/transactions', $transaction->toArray())
            ->assertSee('The description field is required.');
    }


    /**
     * @test
     */
    public function it_cannot_create_transactions_without_a_category()
    {
        $transaction = factory(Transaction::class)->make(['category_id' => null]);

        $resp = $this->withoutExceptionHandling()->post('/budget/transactions', $transaction->toArray())
            ->assertSee('The category id field is required.');
    }


    /**
     * @test
     */
    public function it_cannot_create_transactions_without_an_amount()
    {
        $transaction = factory(Transaction::class)->make(['amount' => null]);

        $resp = $this->withoutExceptionHandling()->post('/budget/transactions', $transaction->toArray())
            ->assertSee('The amount field is required.');
    }

    /**
     * @test
     */
    public function it_cannot_create_transactions_without_a_valid_amount_format()
    {
        $transaction = factory(Transaction::class)->make(['amount' => 'abc']);

        $resp = $this->withoutExceptionHandling()->post('/budget/transactions', $transaction->toArray())
            ->assertSee('The amount format is invalid.');
    }
}
