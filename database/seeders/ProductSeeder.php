<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
            [
                'product_name' => 'ROG Strix B550-A Gaming',
                'product_brand_id' => '3',
                'product_category_id' => '2',
                'product_spec_id' => '13',
                'product_cart_image_name' => 'rog-strix-b550-a-gaming-cart.png',
                'product_description' => 'Designed for those seeking to get the most out of their build, ROG Strix B550 Gaming series motherboards offer a feature-set usually found in the higher-end ROG Strix X570 Gaming series, including the latest PCIe® 4.0 connectivity. Offering robust power delivery and effective cooling, ROG Strix B550-A Gaming is well-equipped to handle 3rd Gen AMD Ryzen™ CPUs. As an added bonus, outstanding performance is complemented by a stunning silver-and-white finish and cyberpunk-inspired aesthetics that present a standout look.',
                'product_base_price' => '965.00',
                'product_quantity' => '5',
                'product_availability' => '1',
            ],
        ]); //
    }
}
