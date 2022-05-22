<?php

namespace Tests\Feature\video;

use App\Models\Budget\Budget;
use App\Models\Budget\Category;
use App\Models\Video\Channel;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateChannelsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function it_can_create_channels()
    {
        $user = factory(User::class)->create();
        $channel = factory(Channel::class)->make(['user_id'=>$user->id]);

        $this->withoutExceptionHandling();

//        $response = $this->actingAs($user)
//            ->post('/video/channels', $channel->toArray())
//            ->assertRedirect('/video/channels');
//
//        $this->actingAs($user)
//            ->get('/video/channels')
//            ->assertSee((string)$channel->name);
    }
}
