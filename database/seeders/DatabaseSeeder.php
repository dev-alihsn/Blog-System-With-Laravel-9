<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Image;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        \App\Models\Role::truncate();
        \App\Models\User::truncate();
        \App\Models\Category::truncate();
        \App\Models\Post::truncate();
        \App\Models\Comment::truncate();
        \App\Models\Tag::truncate();
        \App\Models\Image::truncate();
        Schema::enableForeignKeyConstraints();

        \App\Models\Role::factory(1)->create();
        \App\Models\Role::factory(1)->create(['name' => 'admin']);
        $users = \App\Models\User::factory(10)->create();
        foreach ($users as $user){
            $user->image()->save(Image::factory()->make());
        }
        \App\Models\User::factory(1)->create([
            'id' => 11,
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'admin',
            'role_id' => 2
        ]);
        \App\Models\Category::factory(10)->create();
        \App\Models\Category::factory(1)->create([
            'name' => 'uncategorized',
            'slug' => 'uncategorized',
            'user_id' => 11
        ]);
        $posts = \App\Models\Post::factory(100)->create();
        \App\Models\Comment::factory(300)->create();
        \App\Models\Tag::factory(93)->create();
        foreach ($posts as $post){
            $tags_ids = [];
            $tags_ids[] = Tag::all()->random()->id;
            $tags_ids[] = Tag::all()->random()->id;
            $tags_ids[] = Tag::all()->random()->id;

            $post->tags()->sync($tags_ids);
            $post->image()->save(Image::factory()->make());
        }
    }
}
