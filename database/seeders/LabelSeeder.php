<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $labels = array(
            array('name' => 'one','bn_name' => 'প্রথম','status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'two','bn_name' => 'দ্বিতীয়','status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'three','bn_name' => 'তৃতীয়','status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'four','bn_name' => 'চতুর্থ','status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'five','bn_name' => 'পঞ্চম','status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'six','bn_name' => 'ষষ্ঠ','status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'seven','bn_name' => 'সপ্তম','status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'eight','bn_name' => 'অষ্টম','status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'nine','bn_name' => 'নবম','status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'ten','bn_name' => 'দশম','status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'eleven','bn_name' => 'একাদশ','status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'twelve','bn_name' => 'দ্বাদশ','status' => 1, 'created_at' => now(), 'updated_at' => now()),
        );

        DB::table('labels')->insert($labels);

    }
}
