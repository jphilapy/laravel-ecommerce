<?php

namespace Tests\Feature\budget;

use App\Models\Budget\Transaction;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DeleteTransactionsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function it_can_delete_transactions()
    {
        $user = factory(User::class)->create();

        $transaction = factory(Transaction::class)->create(
            ['user_id' => $user->id]
        );

        $this->actingAs($user)->delete("/budget/transactions/{$transaction->id}")
        ->assertRedirect('/budget/show-transactions');

        $this->actingAs($user)->get('/budget/show-transactions')
            ->assertDontSee($transaction->description);
    }
}
