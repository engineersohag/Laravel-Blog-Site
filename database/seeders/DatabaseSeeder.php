<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        //2 Admin
        \App\Models\User::factory()->count(2)->create([
            'usertype' => 'admin',
        ]);

        // 3 Regular user
        \App\Models\User::factory()->count(3)->create();

        // 10 Category 
        \App\Models\Category::factory()->count(10)->create();

        // 10 Post and 3 comment in every post
        \App\Models\Post::factory()->count(10)->create()->each(function ($post) {
            \App\Models\Comment::factory()->count(3)->create([
                'post_id' => $post->id,
            ]);
        });
    }

}
