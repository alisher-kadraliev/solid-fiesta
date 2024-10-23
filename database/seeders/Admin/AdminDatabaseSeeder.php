<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Seeder;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminUsersTableSeeder::class,
        ]);
    }
}
