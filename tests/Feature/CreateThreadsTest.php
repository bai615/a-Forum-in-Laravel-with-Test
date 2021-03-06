<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    /*public function an_authenticated_user_can_create_new_forum_threads()
    {
        // Given we have a signed in user
        $this->actingAs(factory('App\User')->create());  // 已登录用户

        // When we hit the endpoint to cteate a new thread
        $thread = factory('App\Thread')->make();
        $this->post('/threads',$thread->toArray());

        // Then,when we visit the thread
        // We should see the new thread
        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }*/

    /** @test */
    /*public function guests_may_not_create_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException'); // 在此处抛出异常即代表测试通过

        $thread = factory('App\Thread')->make();
        $this->post('/threads',$thread->toArray());
    }*/

    /** @test */
    public function guests_may_not_see_the_create_thread_page()
    {
        $this->get('/threads/create')
            ->assertRedirect('/login');
    }


    /** @test */
    public function guests_may_not_create_threads()
    {
        $this->withExceptionHandling();

        $this->get('/threads/create')
            ->assertRedirect('/login');

        $this->post('/threads')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        // Given we have a signed in user
        $this->signIn(create('App\User'));  // 已登录用户

        // When we hit the endpoint to cteate a new thread
        $thread = create('App\Thread');
        $this->post('/threads',$thread->toArray());
//dd($thread->path());
        // Then,when we visit the thread
        // We should see the new thread
        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
