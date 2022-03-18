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
    // tableの初期化
    use RefreshDatabase;

    /**
     * Controller test
     *
     * @return void
     */
    public function testThreadController(): void
    {
        Thread::factory()->count(20)->create();

        // indexページへのアクセス
        $response = $this->get('/');
        $response->assertOk();

        // ページネーション確認（10件ずつ取得）
        $data = $response->getOriginalContent()->getData();
        $this->assertCount(10, $data['items']);

        // post時の処理
        $this->post('/', [
        'author' => 'test',
        'message' => 'post test'
        ])->assertRedirect('/');
    }
}
