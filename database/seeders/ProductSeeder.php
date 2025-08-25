<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create(['name' => 'Beta Alanine','description' => 'Description for Beta Alanine','category_id' => 1,]);
        Product::create(['name' => 'Caffeine Anhydrous','description' => 'Description for Caffeine Anhydrous','category_id' => 1,]);
        Product::create(['name' => 'Creatine Monohydrate','description' => 'Description for Creatine Monohydrate','category_id' => 1,]);
        Product::create(['name' => 'L-Citrulline','description' => 'Description for L-Citrulline','category_id' => 1,]);
        Product::create(['name' => 'L-Arginine','description' => 'Description for L-Arginine','category_id' => 1,]);
        Product::create(['name' => 'Red Dye','description' => 'Description for Red Dye','category_id' => 3,]);
        Product::create(['name' => 'Blue Dye','description' => 'Description for Blue Dye','category_id' => 3,]);
        Product::create(['name' => 'Lemon Flavor','description' => 'Description for Lemon Flavor','category_id' => 2,]);
        Product::create(['name' => 'Orange Flavor','description' => 'Description for Orange Flavor','category_id' => 2,]);
        Product::create(['name' => 'Vanilla Flavor','description' => 'Description for Vanilla Flavor','category_id' => 2,]);
        Product::create(['name' => 'Standard Lid','description' => 'Description for Standard Lid','category_id' => 4,]);
        Product::create(['name' => 'Standard Bottle','description' => 'Description for Standard Bottle','category_id' => 5,]);
        Product::create(['name' => 'Standard Scoop','description' => 'Description for Standard Scoop','category_id' => 6,]);
        Product::create(['name' => 'Standard Dessicant','description' => 'Description for Standard Dessicant','category_id' => 7,]);
    }
}
