<?php

namespace Database\Seeders;

use App\Models\PackageInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PackageInfo::updateOrCreate([
            'name' => '3 Star Package',
            'mak_hotel' => 'Fajar badie Hotel or similar',
            'mak_hotel_desc' => '750 Mtr from Haram, Ibrahim Khalil Road',
            'mad_hotel' => 'Hotel Bosphorus or similar',
            'mad_hotel_desc' => '350 Mtr from Masjid Al Nabawi',
        ]);

        PackageInfo::updateOrCreate([
            'name' => '3 Star Standard',
            'mak_hotel' => 'Riyada al Hijra or Similar',
            'mak_hotel_desc' => 'Distance 650 Meter',
            'mad_hotel' => 'Karam Golden / Silver',
            'mad_hotel_desc' => 'Distance 400 Meter',
        ]);

        PackageInfo::updateOrCreate([
            'name' => 'Economy',
            'mak_hotel' => 'Rehab al Bustan or Similar',
            'mak_hotel_desc' => 'Distance 700 Meter',
            'mad_hotel' => 'Diyar al Ghara or Similar',
            'mad_hotel_desc' => 'Distance 500 Meter',
        ]);

        PackageInfo::updateOrCreate([
            'name' => 'Super Economy',
            'mak_hotel' => 'Dar Mostafa / Similar',
            'mak_hotel_desc' => 'Distance 800 Meter',
            'mad_hotel' => 'Marahaba Palace / Similar',
            'mad_hotel_desc' => 'Distance 650 Meter',
        ]);

        PackageInfo::updateOrCreate([
            'name' => '5 Star Premium',
            'mak_hotel' => 'Makkah Hotel / Similar',
            'mak_hotel_desc' => 'Distance 0 (Zero) -  Meter',
            'mad_hotel' => 'Madinah Hilton / Similar',
            'mad_hotel_desc' => 'Distance 0 - 100 Meter',
        ]);

        PackageInfo::updateOrCreate([
            'name' => '5 Star Gold',
            'mak_hotel' => 'Pullman ZamZam / Similar',
            'mak_hotel_desc' => 'Distance 0 (Zero) Meter',
            'mad_hotel' => 'Millennium al Aqeeq / Similar',
            'mad_hotel_desc' => 'Distance 100 Meter',
        ]);

        PackageInfo::updateOrCreate([
            'name' => '5 Star Silver',
            'mak_hotel' => 'Sheraton Makkah / Shaza Makkah',
            'mak_hotel_desc' => 'Distance 100 Meter',
            'mad_hotel' => 'Crowne Plaza / Al Eiman Royal',
            'mad_hotel_desc' => 'Distance 200 Meter',
        ]);

        PackageInfo::updateOrCreate([
            'name' => '5 Star & 3 Star',
            'mak_hotel' => 'Swissotel Makkah / Similar',
            'mak_hotel_desc' => 'Distance 50 Meter',
            'mad_hotel' => 'Dar al Eiman al Taibah / Similar',
            'mad_hotel_desc' => 'Distance 200 Meter',
        ]);

    }
}
