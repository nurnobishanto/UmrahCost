<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(CRMSeeder::class);
        $this->call(SourceSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(PackageInfoSeeder::class);
        $this->call(HotelInfoSeeder::class);
        $this->call(PackageRateSeeder::class);
        $this->call(FlightInfoSeeder::class);
    }
}
