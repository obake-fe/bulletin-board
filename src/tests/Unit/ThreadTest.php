<?php

    namespace Tests\Unit;

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
     * Model test
     *
     * @return void
     */
    public function testThreadModel(): void
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
