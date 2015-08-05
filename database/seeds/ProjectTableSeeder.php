<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \GerenciadorProjetos\Entities\Project::truncate();
        factory(\GerenciadorProjetos\Entities\Project::class, 10)->create();
    }
}
