<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [

            'title' => fake()->sentence,
            'description' => fake()->optional()->paragraph,
            'status' => fake()->randomElement(['pending', 'completed', 'canceled']),
            'user_id' => 1,
            'completed_at' => fn(array $attributes) =>
            $attributes['status'] === 'completed'
                ? Carbon::now()->subDays(rand(1, 30))
                : null,
        ];
    }
}
