<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\Setup;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {
//            $this->command->call('migrate:fresh');
//            $this->command->line("Data cleared, starting from blank database.");
//        }
        DB::table('users')->insert([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'username' => implode('@', explode('@',"imamhujur0@gmail.com", -1)),
            'type'=> 'admin',
            'email_verified_at' => now(),
            'password'=>Hash::make('000000')
        ]);
        \App\Models\User::factory(10)->create()->each(function ($user){
            Conversation::factory(1)->create([
                'sender_id' => $user->id,
                'receiver_id' => 1
            ]);
        });
        \App\Models\Setup::factory(1)->create();
        $this->call(LabelSeeder::class);
        $this->call(YearSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(ShiftSeeder::class);
        $this->call(MediumSeeder::class);



//        $this->call(DivisionSeeder::class);
//        $this->call(DistrictSeeder::class);
//        $this->call(UpazilaSeeder::class);
//        $this->call(UnionSeeder::class);

    }
}
