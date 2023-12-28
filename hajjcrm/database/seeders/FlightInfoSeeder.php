<?php

namespace Database\Seeders;

use App\Models\FlightInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlightInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FlightInfo::updateOrCreate([
            'name'=>'Direct Flight - Saudia Airlines',
        ]);
        FlightInfo::updateOrCreate([
            'name'=>'Transit Flight - Kuwait/Any',
        ]);
    }
}
