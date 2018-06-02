<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'title' => 'Web Design',
                'slug' => 'web-design'
            ],
            [
                'title' => 'Programmer',
                'slug' => 'programer'
            ],
            [
                'title' => 'PHP',
                'slug' => 'php'
            ],
        ]);

        for ($i = 1; $i <= 10; $i ++ ){
            $category_id = rand(1,5);
            DB::table('posts')
                ->where('id', $i)
                ->update(['category_id' => $category_id]);
        }
    }
}
