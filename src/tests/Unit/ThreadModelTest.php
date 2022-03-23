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

    /**
     * authorPartialMatchTest
     *
     * @return void
     */
    public function testScopeAuthorPartialMatch(): void
    {
        // 初期状態
        Thread::factory()->count(10)->create();

        $query = Thread::authorPartialMatch()->get();
        $this->assertCount(10, $query);

        // 検索ワードがある場合
        Thread::factory()->create([
            'author' => 'test',
            'message' => 'hoge'
        ]);

        $queryWithKeyword = Thread::authorPartialMatch('test')->get();
        $this->assertEquals('test', $queryWithKeyword[0]['author']);
    }

    /**
     * messagePartialMatch
     *
     * @return void
     */
    public function testScopeMessagePartialMatch(): void
    {
        // 初期状態
        Thread::factory()->count(10)->create();

        $query = Thread::messagePartialMatch()->get();
        $this->assertCount(10, $query);

        // 検索ワードがある場合
        Thread::factory()->create([
            'author' => 'hoge',
            'message' => 'test'
        ]);

        $queryWithKeyword = Thread::messagePartialMatch('test')->get();
        $this->assertEquals('test', $queryWithKeyword[0]['message']);
    }
}
