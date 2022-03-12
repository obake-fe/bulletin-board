<?php

namespace Database\Factories;

use App\Models\Thread;
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
          'message' => $this->faker->sentence
        ];
    }
}
