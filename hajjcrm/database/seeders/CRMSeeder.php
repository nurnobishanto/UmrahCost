<?php

namespace Database\Seeders;

use App\Models\CRM;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CRMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CRM::updateOrCreate([
            'name' => 'Draft'
        ]);
        CRM::updateOrCreate([
            'name' => 'Outsource'
        ]);
        CRM::updateOrCreate([
            'name' => 'Website'
        ]);
        CRM::updateOrCreate([
            'name' => 'Email'
        ]);
        CRM::updateOrCreate([
            'name' => 'SMS'
        ]);
        CRM::updateOrCreate([
            'name' => 'Shakil'
        ]);
        CRM::updateOrCreate([
            'name' => 'Comilla Office'
        ]);
        CRM::updateOrCreate([
            'name' => 'Shephards'
        ]);
        CRM::updateOrCreate([
            'name' => 'Trip360'
        ]);
    }
}
