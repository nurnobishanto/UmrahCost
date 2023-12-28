<?php

namespace Database\Seeders;

use App\Models\Source;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Source::updateOrCreate([
            'name' => 'Shakil'
        ]);
        Source::updateOrCreate([
            'name' => 'Shakil Personal'
        ]);
        Source::updateOrCreate([
            'name' => 'Shihab'
        ]);
        Source::updateOrCreate([
            'name' => 'Rafiq'
        ]);
        Source::updateOrCreate([
            'name' => 'Hannan'
        ]);
        Source::updateOrCreate([
            'name' => 'Amin'
        ]);
        Source::updateOrCreate([
            'name' => 'Jubayer'
        ]);
        Source::updateOrCreate([
            'name' => 'Shohel'
        ]);
        Source::updateOrCreate([
            'name' => 'Apon'
        ]);
        Source::updateOrCreate([
            'name' => 'Mokaddes'
        ]);
        Source::updateOrCreate([
            'name' => 'Samir'
        ]);
        Source::updateOrCreate([
            'name' => 'Tasfin'
        ]);
        Source::updateOrCreate([
            'name' => 'Sabbir'
        ]);
        Source::updateOrCreate([
            'name' => 'Rashed'
        ]);
    }
}
