<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create(['name' => 'Project A', 'descriptor' => 'Apple', 'servings' => 10]);
        Project::create(['name' => 'Project B', 'descriptor' => 'Banana', 'servings' => 20]);
        Project::create(['name' => 'Project C', 'descriptor' => 'Cherry', 'servings' => 30]);
        Project::create(['name' => 'Project D', 'descriptor' => 'Date', 'servings' => 40]);
        Project::create(['name' => 'Project E', 'descriptor' => 'Elderberry', 'servings' => 50]);
        Project::create(['name' => 'Project F', 'descriptor' => 'Fig', 'servings' => 60]);
        Project::create(['name' => 'Project G', 'descriptor' => 'Grape', 'servings' => 70]);
        Project::create(['name' => 'Project H', 'descriptor' => 'Honeydew', 'servings' => 80]);
    }
}
