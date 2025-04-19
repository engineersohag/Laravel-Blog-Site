<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id ?? 1,
            'user_id' => \App\Models\User::inRandomOrder()->first()->id ?? 1,
            'image' => $this->faker->imageUrl(640, 480, 'blog', true), // Fake image URL
            'description' => $this->faker->paragraph(20),
            'name' => $this->faker->name(),
            'post_status' => 'published',
            'usertype' => $this->faker->randomElement(['admin', 'user']),
        ];
    
    }
}
