<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaticOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        set_static_option('company_name', 'Zamzam Travels BD');
        set_static_option('phone', '01733391826');
        set_static_option('email', 'info@zamzamtravelsbd.com');
        set_static_option('address', '32, Purana Paltan, (Sultan Ahmed Plaza),, Dhaka 1000');
        set_static_option('logo', null);
    }
}
