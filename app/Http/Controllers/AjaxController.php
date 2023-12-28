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
    
    public function roomTypeByTravelerAndHotel($nos_of_traveler, $hotel_id)
    {
        return RoomType::where([['nos_of_traveler',$nos_of_traveler],['hotel_id',$hotel_id],['status',1]])->get();
    }
    
}
