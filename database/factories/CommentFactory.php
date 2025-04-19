<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id ?? 1,
            'post_id' => \App\Models\Post::inRandomOrder()->first()->id ?? 1,
            'parent_id' => null, // Reply না থাকলে null
            'comment' => $this->faker->sentence(10),
        ];
    
    }
}
