<?php

namespace Tests\Feature\budget;

use App\Models\Budget\Category;
use App\Models\Budget\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewTransactionsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function it_allows_only_authenticated_users_to_the_transactions_list()
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
        $category = factory(Category::class)->create(['user_id'=>$user->id]);
        $transaction = factory(Transaction::class)->create(['category_id'=>$category->id,'user_id'=>$user->id]);

        $this->actingAs($user)
            ->withExceptionHandling()
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

        $category = factory(Category::class)->create(['user_id'=>$user->id]);
        $transaction = factory(Transaction::class)->create([
            'user_id'=> $user->id,
            'category_id'=>$category->id
        ]);

//        dd($category);
        $otherTransaction = factory(Transaction::class)->create(['user_id'=>99, 'category_id'=>$category->id]);

        $this->actingAs($user)
<<<<<<< HEAD
            ->get('/budget/show-transactions/' . $category->slug)
=======
            ->withoutExceptionHandling()
            ->get('/budget/transactions/' . $category->slug)
>>>>>>> tdd-laravel-budget
            ->assertSee($transaction->description)
            ->assertDontSee($otherTransaction->description);

    }

    /**
     * @test
     */

    public function it_only_displays_transactions_that_belong_to_the_currently_logged_in_user()
    {


        $user = factory(User::class)->create();
        $category = factory(Category::class)->create(['user_id'=>$user->id]);

        $otheruser = factory(User::class)->create();

        $transaction = factory(Transaction::class)->create(
            [
                'user_id' => $user->id,
                'category_id'=>$category->id
            ]
        );

        $othertransaction = factory(Transaction::class)->create(
            ['user_id' => $otheruser->id]
        );

        $this->actingAs($user)
<<<<<<< HEAD
            ->get('/budget/show-transactions')
=======
            ->withoutExceptionHandling()
            ->get('/budget/transactions')
>>>>>>> tdd-laravel-budget
            ->assertSee($transaction->description)
            ->assertDontSee($othertransaction->description);

    }

    /**
     * @test
     */
    public function it_can_filter_transactions_by_month()
    {
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create(['user_id'=>$user->id]);

        $currentTransaction = factory(Transaction::class)->create();
        $pastTransaction = factory(Transaction::class)->create(
            ['category_id'=>$category->id,'user_id' => $user->id, 'created_at' => Carbon::now()->subMonth(2)]
        );

        $this->actingAs($user)
            ->withoutExceptionHandling()
            ->get('/budget/transactions?month=' . Carbon::now()->subMonth(2)->format('M'))
            ->assertSee($pastTransaction->description)
            ->assertDontSee($currentTransaction->description);
    }

    /**
     * @test
     */
    public function it_can_filter_transactions_by_current_month_by_default()
    {
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create(['user_id'=>$user->id]);

        $currentTransaction = factory(Transaction::class)->create(['category_id'=>$category->id,'user_id'=>$user->id]);
        $pastTransaction = factory(Transaction::class)->create(
            ['user_id' => $user->id, 'created_at' => Carbon::now()->subMonth(2)]
        );

        $this->actingAs($user)
            ->withoutExceptionHandling()
            ->get('/budget/transactions/')
            ->assertSee($currentTransaction->description)
            ->assertDontSee($pastTransaction->description)
        ;
    }
}
