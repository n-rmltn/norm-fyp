<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSpecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_spec')->insert([
            [
                'product_spec_cat' => '1',
                'product_spec_name' => 'AM4',
            ],
            [
                'product_spec_cat' => '1',
                'product_spec_name' => 'AM5',
            ],
            [
                'product_spec_cat' => '1',
                'product_spec_name' => 'LGA 1150',
            ],
            [
                'product_spec_cat' => '1',
                'product_spec_name' => 'LGA 1151',
            ],
            [
                'product_spec_cat' => '1',
                'product_spec_name' => 'LGA 1200',
            ],
            [
                'product_spec_cat' => '1',
                'product_spec_name' => 'LGA 1700',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'A320',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'B350',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'X370',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'B450',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'X470',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'A520',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'B550',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'X570',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'A620',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'B650',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'X670',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'B250',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'Q250',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'H270',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'Q270',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'Z270',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'Z370',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'H310',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'B360',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'H370',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'Q370',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'Z390',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'H410',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'B460',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'H470',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'Q470',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'Z490',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'H510',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'B560',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'H570',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'Z590',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'Z690',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'Q670',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'H670',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'B660',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'H610',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'Z790',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'H770',
            ],
            [
                'product_spec_cat' => '2',
                'product_spec_name' => 'B760',
            ],
            [
                'product_spec_cat' => '3',
                'product_spec_name' => 'DDR4',
            ],
            [
                'product_spec_cat' => '3',
                'product_spec_name' => 'DDR5',
            ],
        ]);
    }
}
