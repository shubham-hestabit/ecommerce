<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class MySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'c_id' => '1',
            'c_name' => 'Milk',
        ]);
        DB::table('categories')->insert([
            'c_id' => '2',
            'c_name' => 'Mobile',
        ]);
        DB::table('categories')->insert([
            'c_id' => '3',
            'c_name' => 'Laptop',
        ]);


        DB::table('sub_categories')->insert([
            'sc_id' => '1',
            'sc_name' => 'Amul',
            'c_id' => '1',
        ]);
        DB::table('sub_categories')->insert([
            'sc_id' => '2',
            'sc_name' => 'Oppo',
            'c_id' => '2',
        ]);
        DB::table('sub_categories')->insert([
            'sc_id' => '3',
            'sc_name' => 'Dell',
            'c_id' => '3',
        ]);


        DB::table('products')->insert([
            'p_id' => '1',
            'p_name' => '100gm',
            'p_price' => 'Rs 10',
            'sc_id' => '1',
        ]);
        DB::table('products')->insert([
            'p_id' => '2',
            'p_name' => '500gm',
            'p_price' => 'Rs 50',
            'sc_id' => '1',
        ]);
        DB::table('products')->insert([
            'p_id' => '3',
            'p_name' => '1 Kg',
            'p_price' => 'Rs 100',
            'sc_id' => '2',
        ]);
    }
}
