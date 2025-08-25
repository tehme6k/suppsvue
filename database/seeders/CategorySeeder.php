<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Active', 'description' => 'Active ingredient']);
        Category::create(['name' => 'Flavor', 'description' => 'Flavor ingredient']);
        Category::create(['name' => 'Color', 'description' => 'Color ingredient']);
        Category::create(['name' => 'Lid', 'description' => 'Product Lid']);
        Category::create(['name' => 'Bottle', 'description' => 'Product Bottle']);
        Category::create(['name' => 'Scoop', 'description' => 'Product Scoop']);
        Category::create(['name' => 'Dessicant', 'description' => 'Product Dessicant']);
    }
}
