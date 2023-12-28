<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Client;
use App\Models\FlightInfo;
use App\Models\GeneralSettings;
use App\Models\HotelInfo;
use App\Models\Package;
use App\Models\PackageInfo;
use App\Models\packageRate;
use App\Models\SuportCost;
use App\Models\Transport;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages=Package::all();
        return view('package.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients=Client::all();

        $packageInfos=PackageInfo::all();
        $flight_infos=FlightInfo::all();
        $transports=Transport::all();
        $supportcost=SuportCost::all();
        $gSetting=GeneralSettings::first();
        return view('package.create', compact('clients', 'packageInfos', 'flight_infos', 'transports', 'supportcost', 'gSetting'));
    }
    public function createclient(Client $client)
    {
        $clients=Client::all();

        $packageInfos=PackageInfo::all();
        $flight_infos=FlightInfo::all();
        $transports=Transport::all();
        $supportcost=SuportCost::all();
        $gSetting=GeneralSettings::first();
        return view('package.create', compact('client','clients', 'packageInfos', 'flight_infos', 'transports', 'supportcost', 'gSetting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        // $request->validate([
        //     'packageinfo_id'=>'required',
        //     'client_id'=>'required',
        //     'hotel_mak'=>'required',
        //     'hotel_mad'=>'required',

        //     'flight_id'=>'required',

        // ]);
        $package= new Package();
        $package->client_id= $request->client_id;
        $package->packageinfo_id= $request->packageinfo_id;

        $package->flight_id= $request->flight_id;
        $package->flight_value= $request->flight_value;
        $package->hotel_mak_id= $request->hotel_mak;
        $package->mak_stays= $request->mak_stays;
        $package->mak_room_type= $request->mak_room_type;
        $package->mak_food_type= $request->mak_food_type;
        $package->mak_hotel_value= $request->mak_hotel_value;
        $package->hotel_mad_id= $request->hotel_mad;
        $package->mad_stays= $request->mad_stays;
        $package->total_stays= ($request->mak_stays + $request->mad_stays) ;
        $package->mad_food_type= $request->mad_food_type;
        $package->mad_hotel_value= $request->mad_hotel_value;
        $package->transportation= $request->transportation;
        $package->transportation_value= $request->transportation_value;
        $package->sightseeing= $request->sightseeing;
        $package->sightseeing_value= $request->sightseeing_value;
        $package->guide= $request->guide;
        $package->guide_charge= $request->guide_charge;
        $package->visa_charge= $request->visa_charge;
        $package->serice_charge= $request->serice_charge;
        $package->total_rel= $request->total_rel;
        $package->total_bdt= $request->total_bdt;

        $package->save();

        return redirect()->route('package.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }
    public function showPdf(Package $package)
    {
        $data['title']='Umrah Package';
        $data['package']=$package;
        $fileName = 'umrahPackage.pdf';
          $pdf = PDF::loadView('package.pdf',
          $data, [], [
            'title' => $fileName,
        ]);
        return $pdf->stream($fileName,'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        $clients=Client::all();

        $packageInfos=PackageInfo::all();
        $flight_infos=FlightInfo::all();
        $transports=Transport::all();
        $supportcost=SuportCost::all();
        $gSetting=GeneralSettings::first();
        return view('package.create', compact('package','clients', 'packageInfos', 'flight_infos', 'transports', 'supportcost', 'gSetting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'package_info_id'=>'required',
            'client_id'=>'required',
            'mak_stays'=>'required',
            'mad_stays'=>'required',
            'room'=>'required',
            'flight'=>'required',
            'cost'=>'required',

        ]);

        $package->package_info_id = $request->package_info_id;
        $package->client_id = $request->client_id;
        $package->mak_stays = $request->mak_stays;
        $package->mad_stays = $request->mad_stays;
        $package->total_stays = $request->mak_stays + $request->mad_stays;
        $package->room = $request->room;
        $package->flight = $request->flight;
        $package->price = $request->cost;

        $package->save();

        return redirect()->route('package.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        //
    }
}
