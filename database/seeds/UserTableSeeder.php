<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        //Generate
        $faker = Faker\Factory::create();

        DB::table('users')->insert([
            [
                'name' => "Paulo Vargatt",
                'email' => "pvargatt@gmail.com",
                'slug' => 'paulo-vargatt',
                'password' => bcrypt('123456'),
                'bio' => $faker->text(rand(250,300))
            ],
            [
                'name' => "Outro Vargatt",
                'email' => "teste@gmail.com",
                'slug' => 'outro-vargatt',
                'password' => bcrypt('123456'),
                'bio' => $faker->text(rand(250,300))

            ],
        ]);
    }
}
