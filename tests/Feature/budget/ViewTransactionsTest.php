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
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get('/budget/transactions')
            ->assertSee($transaction->description)
            ->assertSee($transaction->category->name);
    }

    /**
     * @test
     */

    public function it_only_displays_transactions_that_belong_to_the_currently_logged_in_user()
    {
        $user = factory(User::class)->create();
        $transaction = factory(Transaction::class)->create(
            ['user_id' => $user->id]
        );

        $otheruser = factory(User::class)->create();
        $othertransaction = factory(Transaction::class)->create(
            ['user_id' => $otheruser->id]
        );

        $this->get('/budget/transactions')
            ->assertSee($transaction->description)
            ->assertDontSee($othertransaction->description);

    }
}
