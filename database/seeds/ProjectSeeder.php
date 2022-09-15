<?php

use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Facades\Schema;
class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            //truncate table before insert data to get fresh data
            Schema::disableForeignKeyConstraints();
            Project::truncate();
            Schema::enableForeignKeyConstraints();

            $data = [
                [
    
                  'name' => 'project 1'
                ],
                [
    
                  'name' => 'project 2'
                ],
                [
    
                    'name' => 'project 3'
                ],
                [
    
                    'name' => 'project 4'
                  ]
                
    
    
            ];
    
            Project::insert($data);
    }
}
