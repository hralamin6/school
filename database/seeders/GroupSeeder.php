<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = array(
            array('name' => 'science','status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'arts','status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'commerce','status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'vocational','status' => 1, 'created_at' => now(), 'updated_at' => now()),
        );

        DB::table('groups')->insert($groups);

    }
}
