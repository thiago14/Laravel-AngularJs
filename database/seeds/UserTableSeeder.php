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
//        \GerenciadorProjetos\Entities\User::truncate();
        factory(\GerenciadorProjetos\Entities\User::class)->create([
            'name' => "Thiago Mori",
            'email' => "thiago.mori@gmail.com",
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
        ]);
        factory(\GerenciadorProjetos\Entities\User::class, 9)->create();
    }
}
