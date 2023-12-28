<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use App\Models\Guide;
use App\Models\Hotel;
use App\Models\Location;
use App\Models\PackageType;
use App\Models\RoomType;
use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OtherController extends Controller
{
    public function customPackageInnitialData(){
        $package_id = 1;

        $packageTypes = PackageType::where([['status', 1], ['package_id', $package_id]])->get();
        $airlines = Airline::where([['status', 1], ['package_id', $package_id]])->get();
        $locations = Location::with(['sightseeings'])->where([['status', 1], ['package_id', $package_id]])->get();
        $transports = Transport::where([['status', 1], ['package_id', $package_id]])->get();
        $guides = Guide::where([['status', 1], ['package_id', $package_id]])->get();

        return response()->json(['packageTypes' => $packageTypes, 'airlines' => $airlines, 'locations' => $locations,'transports' => $transports,'guides' => $guides,  'message' => 'Ok', 'status' => 200],200);
    } 
    
    public function hotelByPackageTypeAndLocation($package_type_id, $location_id)
    {
        $hotels = Hotel::where([['package_type_id',$package_type_id],['location_id',$location_id],['status',1]])->get();

        return response()->json(['hotels' => $hotels,  'message' => 'Ok', 'status' => 200],200);
    }
    
    public function roomTypeByTravelerAndHotel($nos_of_traveler, $hotel_id)
    {
        $roomTypes = RoomType::where([['nos_of_traveler',$nos_of_traveler],['hotel_id',$hotel_id],['status',1]])->get();
        
        return response()->json(['roomTypes' => $roomTypes, 'message' => 'Ok', 'status' => 200],200);

    }
}
