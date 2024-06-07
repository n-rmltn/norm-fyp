<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_category')->insert([
            [
                'product_category_name' => 'CPU',
            ],
            [
                'product_category_name' => 'Motherboard',
            ],
            [
                'product_category_name' => 'Memory',
            ],
            [
                'product_category_name' => 'Graphics Card',
            ],
            [
                'product_category_name' => 'Storage',
            ],
            [
                'product_category_name' => 'Power Supply',
            ],
        ]); //
    }
}
