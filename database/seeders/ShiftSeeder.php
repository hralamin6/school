<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shifts = array(
            array('name' => 'day', 'status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'morning', 'status' => 1, 'created_at' => now(), 'updated_at' => now()),
        );

        DB::table('shifts')->insert($shifts);
    }
}
