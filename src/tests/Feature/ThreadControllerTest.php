<?php

  namespace Tests\Feature;

  use App\Models\Thread;
  use Illuminate\Foundation\Testing\RefreshDatabase;
  use Tests\TestCase;

/**
* ThreadControllerTest
*/
class ThreadControllerTest extends TestCase
{
    // initialize table
    use RefreshDatabase;

    /**
     * test about index function
     *
     * @return void
     */
    public function testIndex(): void
    {
        Thread::factory()->count(20)->create();

        // access to index
        $response = $this->get('/');
        $response->assertOk();

        // check pagination (get items by 10)
        $data = $response->getOriginalContent()->getData();
        $this->assertCount(10, $data['items']);


        // with search keyword
        Thread::factory()->create([
            'author' => 'hoge',
            'message' => 'test'
        ]);

        $responseWithKeyword = $this->call('GET', '/', ['keyword' => 'test']);
        $responseWithKeyword->assertOk();

        $dataWithKeyword = $responseWithKeyword->getOriginalContent()->getData();
        $this->assertCount(1, $dataWithKeyword['items']);
    }

    /**
     * test about create function
     *
     * @return void
     */
    public function testCreate(): void
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
