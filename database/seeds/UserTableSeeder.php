<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

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
       // $this->createUser();
    }


//    private function createUser()
//    {
//        $output = new ConsoleOutput();
//        $progress = new ProgressBar($output,10000);
//        $progress->start();
//
//        $max = 10000;
//        for($i=0; $i < $max; $i++):
//            $this->createUsers($i);
//            $progress->advance();
//        endfor;
//        $progress->finish();
//        $this->command->info($max . ' demo Pacientes created');
//    }
//
//    private function createUsers($index)
//    {
//        $faker = Faker\Factory::create();
//
//        return \App\User::create([
//            'name'  =>'User '. $index,
//            'email' => "pvargatt.$index.@gmail.com",
//            'slug' => 'paulo-vargatt',
//            'password' => '123456',
//        ]);
//    }

}
