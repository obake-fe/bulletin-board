<?php

  namespace Tests\Feature;

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


        // image post success
        Storage::fake('local');

        $file = UploadedFile::fake()->image('test.png');
        $this->post('/', [
            'author' => 'test',
            'message' => 'image post test',
            'image' => $file
        ])->assertRedirect('/');

        Storage::disk('local')->assertExists('public/images/test.png');


        // post fail (validation error)
        $this->post('/reply', [
            'author' => '',
            'message' => 'post test'
        ])->assertStatus(302);
    }
}
