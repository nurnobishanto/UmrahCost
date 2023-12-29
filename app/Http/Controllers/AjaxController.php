<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\PackageType;
use App\Models\RoomType;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    // public function travelerNumberWiseRoom($nos_of_traveler)
    // {
    //     return RoomType::where([['nos_of_traveler',$nos_of_traveler],['status',1]])->get();
    // }

    // public function packageWisePackageType($package_id)
    // {
    //     return PackageType::where([['package_id',$package_id],['status',1]])->get();
    // }

    public function hotelByPackageTypeAndLocation($package_type_id, $location_id)
    {
        return Hotel::where([['package_type_id',$package_type_id],['location_id',$location_id],['status',1]])->get();
    }

    public function roomTypeByTravelerAndHotel(Request $request,$nos_of_traveler, $hotel_id)
    {
        $from_travel_date = $request->from_travel_date;
        $travel_date = $request->travel_date;

        $roomTypes = RoomType::where([
            ['nos_of_traveler', $nos_of_traveler],
            ['hotel_id', $hotel_id],
            ['status', 1],
        ]);

//        if ($from_travel_date) {
//            $roomTypes->whereDate('from_date', '<=', $from_travel_date);
//            $roomTypes->whereDate('to_date', '>=', $from_travel_date);
//        }
        if ($travel_date) {
            $roomTypes->whereDate('from_date', '<=', $travel_date);
            $roomTypes->whereDate('to_date', '>=', $travel_date);
        }

        return $roomTypes->get();
    }

}
