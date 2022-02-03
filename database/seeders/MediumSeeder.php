<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mediums = array(
            array('name' => 'bangla','status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'english','status' => 1, 'created_at' => now(), 'updated_at' => now()),
        );

        DB::table('mediums')->insert($mediums);
    }
}
