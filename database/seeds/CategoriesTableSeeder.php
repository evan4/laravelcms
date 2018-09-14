<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        DB::table('categories')->insert([
            [
                'title' => 'Uncetegories',
                'slug' => 'uncetegories'
            ],
            [
                'title' => 'Tips and tricks',
                'slug' => 'tips-and-tricks'
            ],
            [
                'title' => 'Build App',
                'slug' => 'build-app'
            ],
            [
                'title' => 'News',
                'slug' => 'news'
            ],
            [
                'title' => 'Social Marketing',
                'slug' => 'social-marketing'
            ],
            
        ]);

        $posts = Post::pluck('id');
        $categories = Category::pluck('id');
        $countCategories = $categories->count() - 1;

        foreach($posts as $postId){

            $categoryId = $categories [rand(1, $countCategories)];
            
            DB::table('posts')->where('id', $postId)
                ->update(['category_id' => $categoryId]);
        }
    }
}
