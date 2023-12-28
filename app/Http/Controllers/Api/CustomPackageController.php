<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use App\Models\CustomPackage;
use App\Models\CustomPackageGuide;
use App\Models\CustomPackageHotel;
use App\Models\Guide;
use App\Models\Location;
use App\Models\Package;
use App\Models\RoomType;
use App\Models\Sightseeing;
use App\Models\Transport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomPackageController extends Controller
{
    public function index()
    {
        $customPackages = CustomPackage::where('client_id', auth()->user()->id)->with(['packageType'])
            ->orderBy('id', 'DESC')->get();

        return response()->json(['customPackages' => $customPackages,  'message' => 'Ok', 'status' => 200], 200);
    }

    public function store(Request $request)
    {
        // Validation Section Starts
        $validator = Validator::make($request->all(), [
            'package_type' => [
                'required',
                Rule::exists('package_types', 'id'),
            ],
            'transport' => [
                'required',
                Rule::exists('transports', 'id'),
            ],
            'travel_date'       => 'required',
            'nos_of_traveler'   => 'required',
            'room_type' => [
                'required',
                'array',
            ],
            'airline' => [
                'required',
                Rule::exists('airlines', 'id'),
            ],
            'hotel' => [
                'required',
                'array',
            ],
            'stay' => [
                'required',
                'array',
            ],
            'location_ids' => [
                'required',
                'array',
            ],
            'sightseeing' => [
                'nullable',
                'array',
            ],
            'guide' => [
                'nullable',
                'array',
            ],
            'total_stay' => [
                'required',
            ],
            'visa'          => 'required',
            'food'          => 'required',
            'note'          => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                'errors' => $validator->getMessageBag()->toArray(),
                'status' => 422
            ), 422);
        }
        // Validation Section Ends


        DB::beginTransaction();

        try {


            $package_id = 1;

            $package = Package::find($package_id);

            $customPackage = new CustomPackage();
            $customPackage->package_type_id         = $request->package_type;
            $customPackage->airline_id              = $request->airline;
            $customPackage->travel_date             = Carbon::parse($request->travel_date);
            $customPackage->total_stay              = $request->total_stay;
            $customPackage->note                    = $request->note;
            $customPackage->nos_of_traveler         = $request->nos_of_traveler;
            $customPackage->ip_address              = $request->ip() ?? '';
            $customPackage->visa_included           = $request->visa ?? 0;
            $customPackage->transport_included      = $request->transport_included ?? 0;
            $customPackage->guide_included          = $request->guide_included ?? 0;
            $customPackage->sightseeing_included    = $request->sightseeing_included ?? 0;
            $customPackage->food_included           = $request->food ?? 0;

            $airline = Airline::find($request->airline);

            $customPackage->airline_cost = $airline->cost;
            if ($request->visa == 1) {
                $customPackage->visa_cost = $package->cost_of_visa;
            }
            if ($request->food == 1) {
                $customPackage->food_cost = $package->food_cost;
            }

            if ($request->transport_included == 1) {
                $customPackage->transport_id = $request->transport;
                $transport = Transport::find($request->transport);
                $customPackage->transport_cost = $transport?->cost;
            }

            $customPackage->conversion_rate = $package?->currency?->value;

            $customPackage->save();

            foreach ($request->location_ids as $key => $location_id) {
                $location = Location::find($location_id);

                $customPackageHotel                     = new CustomPackageHotel();

                if ($request->sightseeing_included == 1) {
                    if ($request->sightseeing[$key]) {
                        $customPackageHotel->sightseeing_id = $request->sightseeing[$key];
                        $sightseeing = Sightseeing::find($request->sightseeing[$key]);
                        $customPackageHotel->sightseeing_cost = $sightseeing?->cost;
                    }
                }

                $customPackageHotel->room_type_id = $request->room_type[$key];
                $roomType = RoomType::find($request->room_type[$key]);
                $customPackageHotel->room_cost = $roomType?->cost_per_day ?? 0;

                $customPackageHotel->custom_package_id  = $customPackage->id;
                $customPackageHotel->hotel_id           = $request->hotel[$key];
                $customPackageHotel->location_id        = $location_id;
                $customPackageHotel->stay_in            = $request->stay[$key];
                $customPackageHotel->save();
            }

            if ($request->guide && count($request->guide)) {
                foreach ($request->guide as $key => $guide_id) {
                    if ($request->guide_included == 1) {
                        $guide = Guide::find($guide_id);

                        if ($guide) {
                            $customPackageGuide                     = new CustomPackageGuide();
                            $customPackageGuide->guide_id = $guide_id;
                            $customPackageGuide->guide_cost = $guide?->cost;
                            $customPackageGuide->custom_package_id  = $customPackage->id;
                            $customPackageGuide->save();
                        }
                    }
                }
            }

            $customPackage->client_id = auth()->user()->id;
            $customPackage->is_verified_otp = 1;
            $customPackage->save();

            DB::commit();
            return response()->json(['message' => 'Custom Package Stored Successfully !',  'status' => 200], 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(array('errors' => 'Whoops ! Something went wrong.Please try again.' . $exception->getMessage(), 'status' => 422), 422);
        }
    }

    public function show($id)
    {
        $customPackage = CustomPackage::with([
            'client', 
            'packageType', 
            'airline', 
            'transport', 
            'packageGuides', 
            'packageGuides.guide', 
            'packageHotels', 
            'packageHotels.roomType', 
            'packageHotels.sightseeing', 
            'packageHotels.location'
        ])->findOrFail($id);


        $totalHotelCost = 0;
        foreach ($customPackage->packageHotels as $key => $packageHotel) {
            $perDayCost = $packageHotel->room_cost / $customPackage?->nos_of_traveler;
            $totalCost = $perDayCost * $packageHotel->stay_in;
            $totalHotelCost += $totalCost;
        }
        $finalCost = $totalHotelCost+$customPackage->visa_cost+$customPackage->airline_cost+$customPackage->transport_cost+$customPackage->packageHotels->sum('sightseeing_cost')+$customPackage->packageGuides->sum('guide_cost')+$customPackage->food_cost;
        $customPackage['total_cost '] =  currency_convertion($finalCost, $customPackage->conversion_rate);
        
        return response()->json(['customPackage' => $customPackage,  'message' => 'Ok', 'status' => 200], 200);
    }
}
