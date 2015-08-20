<?php

use Illuminate\Database\Seeder;

class ProjectTaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \GerenciadorProjetos\Entities\ProjectTask::truncate();
        factory(\GerenciadorProjetos\Entities\ProjectTask::class, 30)->create();
    }
}
