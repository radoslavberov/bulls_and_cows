<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            for ($i = 0; $i < 3; $i++) {
                DB::table('games')->insert([
                    'user_id' => $user->id,
                    'attempts' => rand(1, 10),
                ]);
            }
        }
    }
}
