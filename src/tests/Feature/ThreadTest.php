<?php

  namespace Tests\Feature;

  use App\Models\Thread;
  use Illuminate\Foundation\Testing\RefreshDatabase;
  use Tests\TestCase;

/**
* ThreadTest
*/
class ThreadTest extends TestCase
{
    // initialize table
    use RefreshDatabase;

    /**
     * ThreadControllerTest about index function
     *
     * @return void
     */
    public function testThreadControllerIndex(): void
    {
        Thread::factory()->count(20)->create();

        // access to index
        $response = $this->get('/');
        $response->assertOk();

        // check pagination (get items by 10)
        $data = $response->getOriginalContent()->getData();
        $this->assertCount(10, $data['items']);
    }

    /**
     * ThreadControllerTest about create function
     *
     * @return void
     */
    public function testThreadControllerCreate(): void
    {
        // post success
        $this->post('/', [
        'author' => 'test',
        'message' => 'post test'
        ])->assertRedirect('/');

        // post fail (validation error)
        $this->post('/', [
            'author' => '',
            'message' => 'post test'
        ])->assertStatus(302);
    }
}
