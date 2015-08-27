<?php

use GerenciadorProjetos\Entities\OauthClient;
use Illuminate\Database\Seeder;

class OauthClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = [
            'id' => 'LavAngId',
            'secret' => 'SeCrEt_WoRd',
            'name' => 'LavAngAPP'
        ];

        OauthClient::create($client);
    }

}
