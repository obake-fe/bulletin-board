<?php

  namespace Tests\Feature;

  use App\Models\Reply;
  use App\Models\Thread;
  use App\Models\User;
  use Illuminate\Foundation\Testing\RefreshDatabase;
  use Illuminate\Http\UploadedFile;
  use Illuminate\Support\Facades\Storage;
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
        $user = User::factory()->create();

        Thread::factory()->count(20)->create();

        // access to index
        $response = $this->actingAs($user)->get('/');
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
     * test about store function
     *
     * @return void
     */
    public function testStore(): void
    {
        $user = User::factory()->create();
        // actingAsメソッドでログイン状態にする
        $authUser = $this->actingAs($user);

        // post success
        $authUser->post('/', [
            'message' => 'post test'
        ])->assertRedirect('/');

        // post fail (validation error)
        $authUser->post('/', [
            'message' => ''
        ])->assertRedirect('/');

        // image post success
        Storage::fake('local');

        $file = UploadedFile::fake()->image('test.png');
        $authUser->post('/', [
            'message' => 'image post test',
            'image' => $file
        ])->assertRedirect('/');

        Storage::disk('local')->assertExists('public/images/test.png');


        // post fail (validation error)
        $authUser->post('/', [
            'message' => 'post test'
        ])->assertStatus(302);
        // reply post success
        $authUser->post('/', [
            'thread_id' => 1,
            'message' => 'reply test'
        ])->assertRedirect('/');

        // reply post fail (validation error)
        $authUser->post('/', [
            'thread_id' => 1,
            'message' => ''
        ])->assertRedirect('/');

        // reply image post success
        Storage::fake('local');
        $file = UploadedFile::fake()->image('test.png');
        $authUser->post('/', [
            'thread_id' => 1,
            'message' => 'image post test',
            'image' => $file
        ])->assertRedirect('/');
        Storage::disk('local')->assertExists('public/images/test.png');
    }

    /**
     * test about edit function
     *
     * @return void
     */
    public function testEdit(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $thread_id = 1;
        $thread = Thread::factory()->create([
            'entry_id' => $thread_id,
            'author' => $user1->name
        ]);
        $reply = Reply::factory()->create([
            'id' => 10,
            'thread_id' => $thread->entry_id,
            'author' => $user1->name
        ]);

        // Edit thread
        $this->actingAs($user1)->get('/edit/1')->assertOk();
        $this->actingAs($user2)->get('/edit/1')->assertRedirect('/');
        $this->actingAs($user1)->get('/edit/2')->assertStatus(404);

        // edit reply
        $this->actingAs($user1)->get('/edit/1/10')->assertOk();
        $this->actingAs($user2)->get('/edit/1/10')->assertRedirect('/');
        $this->actingAs($user1)->get('/edit/1/20')->assertStatus(404);
    }
}
