<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          'name' => 'Administrator',
          'email' => 'administrator@stockmanager.local',
          'password' => bcrypt('stockmanagerdefault'),
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
