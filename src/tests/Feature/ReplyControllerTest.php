<?php

  namespace Tests\Feature;

  use App\Models\User;
  use Illuminate\Foundation\Testing\RefreshDatabase;
  use Illuminate\Http\UploadedFile;
  use Illuminate\Support\Facades\Storage;
  use Tests\TestCase;

/**
* ReplyControllerTest
*/
class ReplyControllerTest extends TestCase
{
    // initialize table
    use RefreshDatabase;

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
        $authUser->post('/reply', [
            'thread_id' => 1,
            'message' => 'reply test'
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
        $authUser->post('/reply', [
            'message' => ''
        ])->assertStatus(302);
    }
}
