<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order')->insert([
            [
                'product_id' => '3',
                'users_id' => '2',
                'order_status' => 'Pending',
                'order_quantity' => '3',
            ],
        ]); //
    }
}
