<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // call UsersTableSeeder and create default admin user
        $this->call(UsersTableSeeder::class);
    }
}
