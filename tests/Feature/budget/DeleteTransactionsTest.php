<?php

namespace Tests\Feature\budget;

use App\Models\Budget\Transaction;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
<<<<<<< HEAD
=======
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
>>>>>>> tdd-laravel-budget
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
<<<<<<< HEAD

        $transaction = factory(Transaction::class)->create(
            ['user_id' => $user->id]
        );

        $this->actingAs($user)->delete("/budget/transactions/{$transaction->id}")
        ->assertRedirect('/budget/show-transactions');

        $this->actingAs($user)->get('/budget/show-transactions')
=======
        $transaction = factory(Transaction::class)->create(['user_id'=>$user->id]);
        $this->actingAs($user)
            ->withoutExceptionHandling()->delete("/budget/transactions/{$transaction->id}")
            ->assertRedirect("/budget/transactions/");

        $this->get("/budget/transactions/")
>>>>>>> tdd-laravel-budget
            ->assertDontSee($transaction->description);
    }
}
