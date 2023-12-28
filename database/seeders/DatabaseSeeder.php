<?php

namespace Database\Seeders;

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
        $this->call(UserSeeder::class);
        $this->call(StaticOptionSeeder::class);

        // only devloper mode
        $this->call(DemoDataSeeder::class);
        $this->call(PermissionSeeder::class);
    }
}
