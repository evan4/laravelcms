<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->truncate();

        $posts = [];
        $faker = Factory::create();
        $date = Carbon::create(2018, 7, 18, 9);

        for($i=0; $i <=10; $i++){
            $image = 'Post_Image_'.rand(1, 5).'.jpg';
            $date->addDays(1);
            $publishedDate = clone($date);
            $createdDate = clone($date);
            
            //$date = date('Y-m-d H:i:s', strtotime("2018-08-13 08:00:00 +$i days"));

            $posts[] = [
                    'author_id' => rand(1,3),
                    'title' => $faker->sentence(rand(0, 12)),
                    'excerpt' => $faker->text(rand(105, 300)),
                    'body' => $faker->paragraph(rand(10, 15)),
                    'slug' => $faker->slug,
                    'image' => rand(0, 1) == 1 ? $image : null,
                    'created_at' => $createdDate,
                    'updated_at' => $createdDate,
                    'published_at' => $i < 5 ? $publishedDate : ( rand(0 ,1) == 0 ? NULL : $publishedDate->addDays(4) ),
                    'view_count' => rand(1 , 10)*10
            ];
        }

        DB::table('posts')->insert($posts);
    }
}
