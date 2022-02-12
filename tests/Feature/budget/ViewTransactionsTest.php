<?php

namespace Tests\Feature\budget;

use App\Models\Budget\Transaction;
use App\Models\Budget\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewTransactionsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function it_allows_only_authenticated_users(): void
    {

        $this->withoutExceptionHandling();

        $response = $this->get('/budget/transactions');

            // ->assertRedirect('login')

            $this->withExceptionHandling();
            $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_can_display_all_transactions()
    {
        $transaction = create(Transaction::class);

        $this->get('/budget/transactions')
            ->assertSee($transaction->description)
            ->assertSee($transaction->category->name);
    }

    /**
     * @test
     */
    public function it_can_filter_transactions_by_category()
    {
        $category = create(Category::class);
        $transaction = create(Transaction::class, ['category_id' => $category->id]);
        $otherTransaction = create(Transaction::class);

        $this->get('/budget/transactions/' . $category->slug)
            ->assertSee($transaction->description)
            ->assertDontSee($otherTransaction->description);
    }
}
