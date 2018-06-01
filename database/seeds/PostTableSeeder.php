<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->truncate();
        //Generate
    $posts = [];
    $faker = Faker\Factory::create();
        for ($i = 1; $i <= 10; $i ++)
        {
            $image = "Post_Image_".rand(1,5).".jpg";
            $date = date("Y-m-d H:i:s", strtotime("2018-06-01 18:00:00 + {$i} days"));
            $posts[] = [
                'author_id' => rand(1,2),
                'title' => $faker->sentence(rand(8,12)),
                'resume' => $faker->text(rand(250,300)),
                'body' => $faker->paragraph(rand(10,15),true),
                'slug' => $faker->slug(),
                'image' => rand(0,1) == 1 ? $image : null,
                'created_at' => $date,
                'updated_at' => $date
            ];
        }
        DB::table('posts')->insert($posts);
    }
}