<?php

namespace Tests\Feature\budget;

use App\Models\Budget\Category;
use App\Models\Video\Channel;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateCategoriesTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */

    public function it_can_update_categories()
    {
        $user = User::factory()->create();
        Channel::factory()->create(['user_id'=>$user->id]);
        $category = Category::factory()->create(['user_id'=>$user->id]);
        $newCategory = Category::factory()->make(['user_id'=>$user->id]);

        $this->actingAs($user)
            ->withoutExceptionHandling()
            ->put("/budget/categories/{$category->slug}", $newCategory->toArray())
        ;

        $this->get('/budget/categories')
            ->assertSee($newCategory->name);
    }

    /**
     * @test
     */
    public function it_cannot_update_categories_without_a_name()
    {
        $user = User::factory()->create();
        Channel::factory()->create(['user_id'=>$user->id]);
        $category = Category::factory()->create(['user_id'=>$user->id]);

        $newCategory = Category::factory()->make(['user_id'=>$user->id,'name'=>null]);

        $response = $this->actingAs($user)
            ->put("/budget/categories/{$category->slug}", $newCategory->toArray())
            ->assertSessionHasErrors('name');
    }
}
