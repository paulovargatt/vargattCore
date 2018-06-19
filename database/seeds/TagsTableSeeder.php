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
       // \Illuminate\Support\Facades\DB::table('tags')->truncate();

        $php = new Tag();
        $php->name = "PHP";
        $php->slug = "php";
        $php->save();

        $laravel = new Tag();
        $laravel->name = "Laravel";
        $laravel->slug = "laravel";
        $laravel->save();

        $webDesign = new Tag();
        $webDesign->name = "Web Design";
        $webDesign->slug = "webDesign";
        $webDesign->save();

        $tags = [
            $php->id,
            $laravel->id,
            $webDesign->id
        ];
        foreach (Post::all() as $post)
        {
            shuffle($tags);
            for ($i = 0; $i < rand(0,count($tags)-1); $i ++){
                $post->tags()->detach($tags[$i]);
                $post->tags()->attach($tags[$i]);
            }
        }
    }
}
