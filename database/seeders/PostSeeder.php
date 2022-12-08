<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        Post::factory(100)
            ->sequence(fn () => ['author_id' => $users->random()->id])
            ->create()
            ->each(function ($post) {
                $post->tags()->save(Tag::factory()->make());
            });
    }
}
