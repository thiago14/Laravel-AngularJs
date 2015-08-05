<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \GerenciadorProjetos\Entities\Client::truncate();
        factory(\GerenciadorProjetos\Entities\Client::class, 10)->create();
    }
}
