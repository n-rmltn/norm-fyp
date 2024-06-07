<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_brand')->insert([
            [
                'product_brand_name' => 'AMD',
            ],
            [
                'product_brand_name' => 'Intel',
            ],
            [
                'product_brand_name' => 'Nvidia',
            ],
            [
                'product_brand_name' => 'ROG',
            ],
        ]); //
    }
}
