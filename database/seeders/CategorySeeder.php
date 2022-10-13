<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
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
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ]);
        DB::table('categories')->insert([
            'c_id' => '2',
            'c_name' => 'Mobile',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ]);
        DB::table('categories')->insert([
            'c_id' => '3',
            'c_name' => 'Laptop',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ]);


        DB::table('sub_categories')->insert([
            'sc_id' => '1',
            'sc_name' => 'Amul',
            'c_id' => '1',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ]);
        DB::table('sub_categories')->insert([
            'sc_id' => '2',
            'sc_name' => 'Oppo',
            'c_id' => '2',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ]);
        DB::table('sub_categories')->insert([
            'sc_id' => '3',
            'sc_name' => 'Dell',
            'c_id' => '3',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ]);


        DB::table('products')->insert([
            'p_id' => '1',
            'p_name' => '100gm',
            'p_price' => 'Rs 10',
            'sc_id' => '1',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ]);
        DB::table('products')->insert([
            'p_id' => '2',
            'p_name' => '500gm',
            'p_price' => 'Rs 50',
            'sc_id' => '1',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ]);
        DB::table('products')->insert([
            'p_id' => '3',
            'p_name' => '1 Kg',
            'p_price' => 'Rs 100',
            'sc_id' => '2',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ]);
    }
}
