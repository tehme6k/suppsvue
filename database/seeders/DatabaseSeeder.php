<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Mpr;
use App\Models\Product;
use App\Models\Project;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Category::factory(15)->create();
        // Product::factory(30)->create();
        // User::factory(10)->create();
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            ProjectSeeder::class,
            MprSeeder::class
        ]);

        User::factory()->create([
            'name' => 'Mothy',
            'email' => 'moshimoshi6k@gmail.com',
            'password' => bcrypt('altoidz012'),
        ]);
    }
}
