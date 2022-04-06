<?php

    namespace Tests\Unit;

    use App\Models\Reply;
    use App\Models\Thread;
    use Illuminate\Database\Eloquent\Collection;
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
     * relation test
     *
     * @see https://dev.to/tonyfrenzy/part-2-testing-model-relationships-in-laravel-basic-3a44
     * @see https://github.com/bitfumes/laravel-test-driven-api/blob/main/tests/Unit/TaskTest.php
     * @return void
     */
    public function testRelation(): void
    {
        $thread = Thread::factory()->create();
        $reply = Reply::factory()->create(['thread_id' => $thread->entry_id]);

        // Method 1: A reply exists in a thread's reply collections.
        $this->assertTrue($thread->replies->contains($reply));

        // Method 2: Replies are related to thread and is a collection instance.
        $this->assertInstanceOf(Collection::class, $thread->replies);

        // Method 3: Replies's first item is related to thread and is a Reply instance.
        $this->assertInstanceOf(Reply::class, $thread->replies->first());
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
