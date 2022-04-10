<?php

namespace Tests\Feature\budget;

use App\Models\Budget\Category;
use App\Models\Budget\Transaction;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewTransactionsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function it_allows_only_authenticated_users()
    {
        $this->get('/budget/show-transactions')
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function it_can_display_all_transactions()
    {
        $user = factory(User::class)->create();
        $transaction = factory(Transaction::class)->create(['user_id'=>$user->id]);

        $this->actingAs($user)
            ->get('/budget/transactions')
            ->assertSee($transaction->description)
            ->assertSee($transaction->category->name);
    }

    /**
     * @test
     */
    public function it_can_filter_transactions_by_category()
    {
        $user = factory(User::class)->create();

        $category = factory(Category::class)->create();
        $transaction = factory(Transaction::class)->create([
            'user_id'=> $user->id,
            'category_id'=>$category->id
        ]);

//        dd($category);
        $otherTransaction = factory(Transaction::class)->create(['user_id'=>99, 'category_id'=>$category->id]);

        $this->actingAs($user)
            ->get('/budget/show-transactions/' . $category->slug)
            ->assertSee($transaction->description)
            ->assertDontSee($otherTransaction->description);

    }

    /**
     * @test
     */

    public function it_only_displays_transactions_that_belong_to_the_currently_logged_in_user()
    {
        $user = factory(User::class)->create();
        $otheruser = factory(User::class)->create();

        $transaction = factory(Transaction::class)->create(
            ['user_id' => $user->id]
        );

        $othertransaction = factory(Transaction::class)->create(
            ['user_id' => $otheruser->id]
        );

        $this->actingAs($user)
            ->get('/budget/show-transactions')
            ->assertSee($transaction->description)
            ->assertDontSee($othertransaction->description);

    }
}
