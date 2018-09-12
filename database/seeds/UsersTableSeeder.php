<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        DB::statement('SET FOREIGN_KEY_CHECKS = 0 ');
        DB::table('users')->truncate();
        
        $users = [];

        for($i=0; $i < 3; $i++){
            $name = $faker->firstName();

            $users[] = [
                'name' => $name,
                'slug' => strtolower($name),
                'email' => strtolower($name).'@gmail.com',
                'password' => bcrypt('secret'),
                'bio' => $faker->text(rand(200, 250))
            ];
        }

        DB::table('users')->insert($users);
    }

}
