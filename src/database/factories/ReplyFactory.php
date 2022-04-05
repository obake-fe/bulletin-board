<?php

namespace Database\Factories;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ReplyFactory extends Factory
{
    protected $model = Reply::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'thread_id' => function () {
                return Thread::factory()->create()->entry_id;
            },
            'author' => $this->faker->name,
            'message' => $this->faker->sentence
        ];
    }
}
