<?php

use Illuminate\Database\Seeder;

class ProjectMemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \GerenciadorProjetos\Entities\ProjectMember::truncate();
        factory(\GerenciadorProjetos\Entities\ProjectMember::class, 30)->create();
    }
}
