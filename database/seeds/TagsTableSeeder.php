<?php

use Illuminate\Database\Seeder;
use App\Tag;
use App\Post;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::truncate();

        $php = new Tag();
        $php->name = 'PHP';
        $php->slug = 'php';
        $php->save();

        $laravel = new Tag();
        $laravel->name = 'Laravel';
        $laravel->slug = 'laravel';
        $laravel->save();

        $symphony = new Tag();
        $symphony->name = 'Symphony';
        $symphony->slug = 'symphony';
        $symphony->save();
        
        $vue = new Tag();
        $vue->name = 'vue JS';
        $vue->slug = 'Vuejs';
        $vue->save();

        $posts = Post::all();
        $tags = [
            $php->id,
            $laravel->id,
            $symphony->id,
            $vue->id
        ];

        foreach($posts as $post){
            shuffle($tags);

            for($i=0; $i < rand(0, count($tags)-1); $i++){
                $post->tags()->detach($tags[$i]);
                $post->tags()->attach($tags[$i]);
            }
        }

    }
}
