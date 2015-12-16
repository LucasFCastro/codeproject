<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \CodeProject\Entities\Project::truncate();
        factory(\CodeProject\Entities\User::class)->create([
            'name' => 'Lucas',
            'email' => 'lucasfcastro@yahoo.com.br',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
        ]);
        factory(\CodeProject\Entities\User::class, 10)->create();
    }
}
