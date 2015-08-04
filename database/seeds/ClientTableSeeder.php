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
        \GerenciadorProjetos\Client::truncate();
        factory(\GerenciadorProjetos\Client::class, 10)->create();
    }
}
