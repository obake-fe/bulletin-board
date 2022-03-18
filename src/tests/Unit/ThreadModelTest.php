<?php

    namespace Tests\Unit;

    use App\Models\Thread;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

/**
 * ThreadModelTest
 */
class ThreadModelTest extends TestCase
{
    // tableの初期化
    use RefreshDatabase;

    /**
     * post test
     *
     * @return void
     */
    public function testPost(): void
    {
        // ダミーデータを用意
        $data = [
            'author' => 'test',
            'message' => 'test message'
        ];

        // データが正しく保存されるか
        $thread = new Thread();
        $thread->fill($data)->save();
        $this->assertDatabaseHas('threads', $data);
    }
}
