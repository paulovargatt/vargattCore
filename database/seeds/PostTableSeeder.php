<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
    $date = Carbon::create(2018,05,20,18,30,00);

        for ($i = 1; $i <= 10; $i ++)
        {
            $image = "Post_Image_".rand(1,5).".jpg";
            $date = $date->addDays(1);
            $publishedDate = clone($date);
            $createdDate = clone($date);
            $posts[] = [
                'author_id' => rand(1,2),
                'title' => $faker->sentence(rand(8,12)),
                'resume' => $faker->text(rand(250,300)),
                'body' => $faker->paragraph(rand(10,15),true),
                'slug' => $faker->slug(),
                'image' => rand(0,1) == 1 ? $image : null,
                'created_at' => $createdDate,
                'updated_at' => $createdDate,
                'published_at' => $i < 5 ? $publishedDate : (rand(0,1) == 0 ? null : $publishedDate->addDays(4))
            ];
        }
        DB::table('posts')->insert($posts);
    }
}
