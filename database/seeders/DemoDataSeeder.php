<?php

namespace Database\Seeders;

use App\Models\Airline;
use App\Models\ClientFeedback;
use App\Models\ClientSource;
use App\Models\ClientStatus;
use App\Models\Currency;
use App\Models\Guide;
use App\Models\Hotel;
use App\Models\Location;
use App\Models\Package;
use App\Models\PackageType;
use App\Models\QueryAbout;
use App\Models\RoomType;
use App\Models\Sightseeing;
use App\Models\Status;
use App\Models\Transport;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Guid\Guid;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Currency::create([
            'id' => 1,
            'name' => 'BDT',
            'sign' => '৳',
            'value' => 1,
            'status' => 1,
        ]);
        Currency::create([
            'id' => 2,
            'name' => 'Riyal',
            'sign' => 'ر.س',
            'value' => 30,
            'status' => 1,
        ]);
        Clientsource::create([
            'id' => 1,
            'name' => 'Facebook',
            'status' => 1,
        ]);
        Clientsource::create([
            'id' => 2,
            'name' => 'Instagranm',
            'status' => 1,
        ]);
        Clientsource::create([
            'id' => 3,
            'name' => 'Linkedin',
            'status' => 1,
        ]);
        Clientsource::create([
            'id' => 4,
            'name' => 'Google',
            'status' => 1,
        ]);
        Clientsource::create([
            'id' => 5,
            'name' => 'Our Client',
            'status' => 1,
        ]);        Clientstatus::create([
            'id' => 1,
            'name' => 'Online client',
            'status' => 1,
        ]);
        Clientstatus::create([
            'id' => 2,
            'name' => 'Lead agent',
            'status' => 1,
        ]);
        Clientstatus::create([
            'id' => 3,
            'name' => 'Active Client',
            'status' => 1,
        ]);
        Clientstatus::create([
            'id' => 4,
            'name' => 'Deactive Client',
            'status' => 1,
        ]);
        Package::create([
            'id' => 1,
            'currency_id' => 2,
            'name' => 'Umrah',
            'invoice_note' => NULL,
            'cost_of_visa' => 25000,
            'food_cost' => 0,
            'status' => 1,
        ]);
        Packagetype::create([
            'id' => 4,
            'package_id' => 1,
            'name' => '3 ‍Star Economy Package',
            'status' => 1,
        ]);        Location::create([
            'id' => 1,
            'package_id' => 1,
            'name' => 'Makkah',
            'status' => 1,
        ]);
        Location::create([
            'id' => 2,
            'package_id' => 1,
            'name' => 'Madina',
            'status' => 1,
        ]);
        Hotel::create([
            'id' => 1,
            'location_id' => 1,
            'package_type_id' => 4,
            'name' => 'Hotel Lulu al Khalil ( 3 Star Economy )',
            'status' => 1,
        ]);
        Hotel::create([
            'id' => 2,
            'location_id' => 2,
            'package_type_id' => 1,
            'name' => 'Park Inn by Radisson Makkah Al Naseem',
            'status' => 1,
        ]);
        Hotel::create([
            'id' => 3,
            'location_id' => 2,
            'package_type_id' => 4,
            'name' => 'Hotel Ziab Center ( 3 Star Economy)',
            'status' => 1,
        ]);        Status::create([
            'id' => 1,
            'name' => 'Pending',
            'status' => 1,
        ]);
        Status::create([
            'id' => 2,
            'name' => 'Reject',
            'status' => 1,
        ]);
        Status::create([
            'id' => 3,
            'name' => 'Processing',
            'status' => 1,
        ]);
        Queryabout::create([
            'id' => 1,
            'name' => 'Hajj',
            'status' => 1,
        ]);
        Queryabout::create([
            'id' => 2,
            'name' => 'Umrah',
            'status' => 1,
        ]);
        Airline::create([
            'id' => 1,
            'package_id' => 1,
            'name' => 'Biman Bangladesh',
            'cost' => 90000,
            'status' => 1,
        ]);
        Airline::create([
            'id' => 2,
            'package_id' => 1,
            'name' => 'Saudi Airlines',
            'cost' => 95000,
            'status' => 1,
        ]);
        Roomtype::create([
            'id' => 2,
            'hotel_id' => 1,
            'name' => 'Double bed',
            'nos_of_traveler' => 2,
            'cost_per_day' => 200,
            'status' => 1,
        ]);
        Roomtype::create([
            'id' => 3,
            'hotel_id' => 1,
            'name' => 'Triple Bed',
            'nos_of_traveler' => 3,
            'cost_per_day' => 300,
            'status' => 1,
        ]);
        Roomtype::create([
            'id' => 7,
            'hotel_id' => 3,
            'name' => 'Double Bed',
            'nos_of_traveler' => 2,
            'cost_per_day' => 200,
            'status' => 1,
        ]);
        Roomtype::create([
            'id' => 8,
            'hotel_id' => 1,
            'name' => 'Quad Bed',
            'nos_of_traveler' => 4,
            'cost_per_day' => 400,
            'status' => 1,
        ]);
        Roomtype::create([
            'id' => 9,
            'hotel_id' => 3,
            'name' => 'Triple Bed',
            'nos_of_traveler' => 3,
            'cost_per_day' => 300,
            'status' => 1,
        ]);
        Roomtype::create([
            'id' => 10,
            'hotel_id' => 3,
            'name' => 'Quad Bed',
            'nos_of_traveler' => 4,
            'cost_per_day' => 400,
            'status' => 1,
        ]);
        Clientfeedback::create([
            'id' => 1,
            'name' => 'Very Good',
            'status' => 1,
        ]);
        Clientfeedback::create([
            'id' => 2,
            'name' => 'Good',
            'status' => 1,
        ]);
        Clientfeedback::create([
            'id' => 3,
            'name' => 'Not Good',
            'status' => 1,
        ]);        Transport::create([
            'id' => 1,
            'package_id' => 1,
            'name' => 'Shared Bus ( Group )',
            'cost' => 100,
            'status' => 1,
        ]);
        Transport::create([
            'id' => 2,
            'package_id' => 1,
            'name' => 'Private Car (Sedan)',
            'cost' => 400,
            'status' => 1,
        ]);
        Transport::create([
            'id' => 3,
            'package_id' => 1,
            'name' => 'H 1 ( Seven Seat )',
            'cost' => 800,
            'status' => 1,
        ]);
        Guide::create([
            'id' => 1,
            'package_id' => 1,
            'name' => 'Basic Guide ( Meet & Assist )',
            'cost' => 50,
            'status' => 1,
        ]);
        Guide::create([
            'id' => 2,
            'package_id' => 1,
            'name' => 'Umrah Guide',
            'cost' => 200,
            'status' => 1,
        ]);
        Sightseeing::create([
            'id' => 1,
            'location_id' => 1,
            'name' => 'With Bus',
            'cost' => 80,
            'status' => 1,
        ]);
        Sightseeing::create([
            'id' => 2,
            'location_id' => 1,
            'name' => 'With Private Car',
            'cost' => 200,
            'status' => 1,
        ]);
        Sightseeing::create([
            'id' => 3,
            'location_id' => 2,
            'name' => 'With Bus',
            'cost' => 80,
            'status' => 1,
        ]);
        Sightseeing::create([
            'id' => 4,
            'location_id' => 2,
            'name' => 'With Private Car',
            'cost' => 200,
            'status' => 1,
        ]);
        Sightseeing::create([
            'id' => 5,
            'location_id' => 1,
            'name' => 'With GMC (SUV)',
            'cost' => 400,
            'status' => 1,
        ]);
        Sightseeing::create([
            'id' => 6,
            'location_id' => 2,
            'name' => 'With GMC (SUV)',
            'cost' => 400,
            'status' => 1,
        ]);
    }
}
