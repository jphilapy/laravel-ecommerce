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
        $category = factory(Category::class)->create();

        $this->actingAs($user)
            ->withoutExceptionHandling()
            ->get('/budget/categories')
            ->assertSee($category->name);
    }
}
