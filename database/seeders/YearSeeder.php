<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $years = array(
            array('name' => 2020,'status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 2021,'status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 2022,'status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 2023,'status' => 1, 'created_at' => now(), 'updated_at' => now()),
        );

        DB::table('years')->insert($years);
    }
}
