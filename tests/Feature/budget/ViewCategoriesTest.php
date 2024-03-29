<?php

namespace Tests\Feature\budget;

use App\Models\Budget\Category;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewCategoriesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_can_display_all_categories()
    {
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create(['user_id'=>$user->id]);

        $this->actingAs($user)
            ->withoutExceptionHandling()
            ->get('/budget/categories')
            ->assertSee($category->name);
    }

    /**
     * @test
     */
    public function it_allows_only_authenticated_users_to_the_categories_list()
    {
        $this->get('/budget/categories')
            ->assertRedirect('/login');
    }

    /**
     * @test
     */

    public function it_only_displays_categories_that_belong_to_the_currently_logged_in_user()
    {
        $user = factory(User::class)->create();
        $otheruser = factory(User::class)->create();

        $category = factory(Category::class)->create(
            ['user_id' => $user->id]
        );

        $otherCategory = factory(Category::class)->create(
            ['user_id' => $otheruser->id]
        );

        $this->actingAs($user)
            ->withoutExceptionHandling()
            ->get('/budget/categories')
            ->assertSee($category->name)
            ->assertDontSee($otherCategory->name);

    }
}
