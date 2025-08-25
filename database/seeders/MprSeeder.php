<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mpr;

class MprSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mpr::create([
            'project_id' => 1,
            'version_nbr' => 1,
            'can_edit' => true,
        ]);

        Mpr::create([
            'project_id' => 1,
            'version_nbr' => 2,
            'can_edit' => true,
        ]);

        Mpr::create([
            'project_id' => 2,
            'version_nbr' => 1,
            'can_edit' => true,
        ]);
    }
}
