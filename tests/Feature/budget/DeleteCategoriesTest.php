<?php

namespace Tests\Feature\budget;

use App\Models\Budget\Category;
use App\Models\Budget\Transaction;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteCategoriesTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function it_can_delete_categories()
    {
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create(['user_id'=>$user->id]);
        $this->actingAs($user)
            ->withoutExceptionHandling()->delete("/budget/categories/{$category->slug}")
            ->assertRedirect("/budget/categories");

        $this->actingAs($user)->get("/budget/categories")
            ->assertDontSee($category->name);
    }
}
