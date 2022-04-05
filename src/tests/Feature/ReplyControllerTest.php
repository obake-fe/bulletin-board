<?php

  namespace Tests\Feature;

  use Illuminate\Foundation\Testing\RefreshDatabase;
  use Tests\TestCase;

/**
* ReplyControllerTest
*/
class ReplyControllerTest extends TestCase
{
    // initialize table
    use RefreshDatabase;

    /**
     * test about create function
     *
     * @return void
     */
    public function testStore(): void
    {

        // post success
        $this->post('/reply', [
        'thread_id' => 1,
        'author' => 'test',
        'message' => 'reply test'
        ])->assertRedirect('/');

        // post fail (validation error)
        $this->post('/reply', [
            'author' => '',
            'message' => 'post test'
        ])->assertStatus(302);
    }
}
