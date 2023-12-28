<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name     = 'Mr. Admin';
        $user->email    = 'admin@gmail.com';
        $user->phone    = '01800000000';
        $user->user_type= 'admin';
        $user->otp_verified= 1;
        $user->password = Hash::make('password');
        $user->save();

        $user = new User();
        $user->name     = 'Mr. CRM';
        $user->email    = 'crm@gmail.com';
        $user->phone    = '01700000000';
        $user->user_type= 'crm';
        $user->otp_verified= 1;
        $user->password = Hash::make('password');
        $user->save();
        
        $user = new User();
        $user->name     = 'Mr. Arafat';
        $user->email    = 'arafathossin7616@gmail.com';
        $user->phone    = '01787620979';
        $user->user_type= 'client';
        $user->otp_verified= 1;
        $user->password = Hash::make('password');
        $user->save();
    }
}
