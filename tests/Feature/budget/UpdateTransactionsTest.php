<?php

namespace Tests\Feature;

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
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $transaction = factory(Transaction::class)->create();
        $newTransaction = factory(Transaction::class)->make();

        $this->actingAs($user)
            ->put("/budget/transactions/{$transaction->id}", $newTransaction->toArray())
            ->assertRedirect('/budget/transactions');

//        $this->actingAs($user)
//            ->get('/budget/transactions')
//            ->assertSee($newTransaction->description);
    }
}
