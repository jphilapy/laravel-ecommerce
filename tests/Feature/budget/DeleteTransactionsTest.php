<?php

namespace Tests\Feature;

use App\Models\Budget\Transaction;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $transaction = factory(Transaction::class)->create(['user_id'=>$user->id]);
        $this->actingAs($user)
            ->withoutExceptionHandling()->delete("/budget/transactions/{$transaction->id}")
            ->assertRedirect("/budget/transactions/");

        $this->get("/budget/transactions/")
            ->assertDontSee($transaction->description);
    }
}
