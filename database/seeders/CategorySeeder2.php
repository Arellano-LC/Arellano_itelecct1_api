<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $categories = [
            'Laptops',
            'Smartphones',
            'Headphones',
            'Tablets',
            'Wearables',
            'Gaming Accessories',

        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'image_path' => 'categories/' . strtolower(str_replace(' ', '_', $categoryName)) . '.jpg',
            ]);
        }
    }
}
