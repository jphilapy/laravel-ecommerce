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
        $user = factory(User::class)->create();
        $transaction = factory(Transaction::class)->create(['user_id'=>$user->id]);
        $newTransaction = factory(Transaction::class)->make(['user_id'=>$user->id]);

        $this->withoutExceptionHandling();

        $this->actingAs($user)
            ->put("/budget/transactions/{$transaction->id}", $newTransaction->toArray())
            ->assertRedirect('/budget/transactions')
;

        $this->actingAs($user)
            ->get('/budget/transactions')
            ->assertSee($newTransaction->description)
;
    }
}
