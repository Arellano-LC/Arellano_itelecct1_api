<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Laptops',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Smartphones',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Headphones',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tablets',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wearables',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gaming Accessories',
                'created_at' => now(),
                'updated_at' => now(),
            ],
          
        ]);
    }
}
