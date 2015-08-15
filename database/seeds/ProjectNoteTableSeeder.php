<?php

use Illuminate\Database\Seeder;

class ProjectNoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \GerenciadorProjetos\Entities\Project::truncate();
        factory(\GerenciadorProjetos\Entities\ProjectNote::class, 50)->create();
    }
}
