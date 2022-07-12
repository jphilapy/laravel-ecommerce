<?php

namespace Tests\Feature\budget;

use App\Models\Budget\Category;
use App\Models\Budget\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateCategoriesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_can_create_categories()
    {
        $user = User::factory()->create();
        $category = Category::factory()->make(['user_id'=>$user->id]);

//        $this->withoutExceptionHandling();
        $response = $this->actingAs($user)
            ->post('/budget/categories', $category->toArray())
            ->assertRedirect('/budget/categories');

        $this->actingAs($user)
            ->get('/budget/categories')
            ->assertSee($category->name);
    }

    /**
     * @test
     */
    public function it_cannot_create_categories_without_a_name()
    {
        $user = User::factory()->create();
        $category = Category::factory()->make(['name' => null]);

        $response = $this->actingAs($user)
            ->withExceptionHandling()
            ->post('/budget/categories', $category->toArray())
            ->assertSessionHasErrors('name');
    }
}
