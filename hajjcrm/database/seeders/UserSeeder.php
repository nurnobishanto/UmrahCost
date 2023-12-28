<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin@123')
        ]);
        User::updateOrCreate([
            'name' => 'rasel',
            'email' => 'rasel@gmail.com',
            'password' => bcrypt('admin@123')
        ]);
    }
}
