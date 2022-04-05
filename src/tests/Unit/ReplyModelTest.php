<?php

    namespace Tests\Unit;

    use App\Models\Reply;
    use App\Models\Thread;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

/**
 * ReplyModelTest
 */
class ReplyModelTest extends TestCase
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
            'thread_id' => 1,
            'author' => 'test',
            'message' => 'test message'
        ];

        // データが正しく保存されるか
        $reply = new Reply();
        $reply->fill($data)->save();
        $this->assertDatabaseHas('replies', $data);
    }

    /**
     * relation test
     *
     * @see https://github.com/bitfumes/laravel-test-driven-api/blob/main/tests/Unit/TodoListTest.php
     * @return void
     */
    public function testRelation(): void
    {
        $thread = Thread::factory()->create();
        $reply = Reply::factory()->create(['thread_id' => $thread->entry_id]);

        // Method 1: Test by count that a thread has a parent relationship with reply
        $this->assertEquals(1, $thread->replies->count());

        // Method 2: Thread is related to reply is a Thread instance.
        $this->assertInstanceOf(Thread::class, $reply->thread);
    }
}
