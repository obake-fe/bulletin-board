<?php

namespace Database\Factories;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ThreadFactory extends Factory
{
    protected $model = Thread::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'author' => $this->faker->name,
            'author_id' => function () {
                return User::factory()->create()->id;
            },
            'message' => $this->faker->sentence
        ];
    }
}
