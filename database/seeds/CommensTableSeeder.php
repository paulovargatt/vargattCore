<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class CommensTableSeeder extends Seeder
{
    public function run()
    {

        $faker = Faker\Factory::create();

        $posts = \App\Post::published()->latest()->take(5)->get();
        foreach ($posts as $post) {
            for ($i = 1; $i <= rand(1, 10); $i++) {
                $commentDate = $post->published_at->modify("+{$i} Horas");

                $comments[] = [
                    'author_name' => $faker->name,
                    'author_email' => $faker->email,
                    'author_url' => $faker->domainName,
                    'body' => $faker->paragraphs(rand(1, 5), true),
                    'post_id' => $post->id,
                    'created_at' => $commentDate,
                    'updated_at' => $commentDate,
                ];
            }
        }
        \App\Comment::insert($comments);

    }
}
