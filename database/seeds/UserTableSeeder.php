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
        DB::table('users')->insert([
            [
                'name' => "Paulo Vargatt",
                'email' => "pvargatt@gmail.com",
                'password' => bcrypt('123456')
            ],
            [
                'name' => "Outro Vargatt",
                'email' => "teste@gmail.com",
                'password' => bcrypt('123456')
            ],
        ]);
    }
}
