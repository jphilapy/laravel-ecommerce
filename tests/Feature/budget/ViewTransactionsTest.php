<?php

namespace Tests\Feature\budget;

use App\Models\Budget\Transaction;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewTransactionsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function it_allows_only_authenticated_users()
    {
//        $user = factory(User::class)->create();
//        ->actingAs($user)

        $this->get('/budget/transactions')
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function it_can_display_all_transactions()
    {
        $transaction = factory(Transaction::class)->create();

        $this->get('/budget/transactions')
            ->assertSee($transaction->description)
            ->assertSee($transaction->category->name);
    }
}
