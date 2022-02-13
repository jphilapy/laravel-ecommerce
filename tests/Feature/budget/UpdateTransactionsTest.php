<?php

namespace Tests\Feature;

use App\Models\Budget\Transaction;
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
        $transaction = factory(Transaction::class)->create();
        $newTransaction = factory(Transaction::class)->make();

        $this->put("/transactions/{$transaction->id}", $newTransaction->toArray())
        ->assertRedirect('/budget/transactions');

        $this->get('/budget/transactions')
            ->assertSee($newTransaction->description);
    }
}
