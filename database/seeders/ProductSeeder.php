<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Userinfo;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Retrieve users by username to get actual IDs
        $user1 = Userinfo::where('username', 'admiral')->first();
        $user2 = Userinfo::where('username', 'admin')->first();

        // Make sure users exist, otherwise throw an error or handle gracefully
        if (!$user1 || !$user2) {
            $this->command->error('Required users not found in usersinfo table.');
            return;
        }

        $products = [
            // Laptops
            ['Apple MacBook Air M2', 'Apple MacBook Air with M2 chip, 13.6-inch Liquid Retina display, and up to 18 hours of battery life.', 1],
            ['Dell XPS 15', '15.6-inch 4K UHD+ display, Intel Core i9, 32GB RAM, NVIDIA RTX 4070.', 1],
            ['Lenovo ThinkPad X1 Carbon Gen 11', '14-inch WUXGA display, Intel Core i7, lightweight business ultrabook.', 1],
            ['HP Spectre x360 14', '13.5-inch OLED touch display, Intel Evo platform, convertible 2-in-1.', 1],

            // Smartphones
            ['Samsung Galaxy S23 Ultra', '6.8-inch AMOLED display, Snapdragon 8 Gen 2, 200MP camera, S-Pen support.', 2],
            ['Google Pixel 7 Pro', '6.7-inch QHD+ OLED, Google Tensor G2 chip, 50MP triple-camera system.', 2],
            ['Apple iPhone 14 Pro', '6.1-inch Super Retina XDR display, A16 Bionic chip, Dynamic Island.', 2],
            ['OnePlus 11', '6.7-inch AMOLED, Snapdragon 8 Gen 2, Hasselblad triple camera.', 2],

            // Headphones
            ['Sony WH-1000XM5', 'Industry-leading noise-canceling wireless headphones with 30-hour battery life.', 3],
            ['Razer BlackShark V2 Pro', 'Wireless gaming headset with THX Spatial Audio and 50mm drivers.', 6],
            ['Bose QuietComfort 45', 'Acoustic Noise Cancelling, 24 hours battery, lightweight design.', 3],
            ['Apple AirPods Max', 'High-fidelity audio, Active Noise Cancellation, spatial audio.', 3],

            // Tablets
            ['Apple iPad Pro M2', '12.9-inch Liquid Retina XDR display, M2 chip, Apple Pencil 2 support.', 4],
            ['Samsung Galaxy Tab S8 Ultra', '14.6-inch AMOLED display, Snapdragon 8 Gen 1, S-Pen included.', 4],
            ['Microsoft Surface Pro 9', '13-inch PixelSense touchscreen, Intel Core i7, detachable keyboard.', 4],

            // Wearables
            ['Apple Watch Series 8', 'Advanced health tracking, Always-On Retina display, IP6X dust resistance.', 5],
            ['Samsung Galaxy Watch 5 Pro', 'GPS, advanced fitness tracking, sapphire crystal display.', 5],
            ['Fitbit Sense 2', 'EDA scan app, ECG app, stress management tools.', 5],

            // Gaming Accessories
            ['Logitech G Pro X Superlight', 'Ultra-lightweight wireless gaming mouse, HERO sensor.', 6],
            ['SteelSeries Apex Pro', 'Mechanical gaming keyboard with adjustable actuation switches.', 6],
        ];

        foreach ($products as $index => [$name, $description, $categoryId]) {
            Product::create([
                'name' => $name,
                'description' => $description,
                'category_id' => $categoryId,
                'user_id' => $index % 2 === 0 ? $user1->id : $user2->id,  // dynamic user IDs
                'price' => rand(300, 2000) * 1.00,
                'image_path' => null,
            ]);
        }
    }
}
