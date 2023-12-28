<?php

namespace App\Http\Controllers;

use App\Models\HotelInfo;
use App\Models\PackageInfo;
use Illuminate\Http\Request;

class HotelInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotelInfos=HotelInfo::all();
        return view('hotel.index', compact('hotelInfos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packageInfos = PackageInfo::all();
        return view('hotel.create', compact('packageInfos'));
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
        $request->validate([
            'name'=>'required',
            'city'=>'required',
            'type'=>'required',
            'code'=>'required',
            'distance'=>'required',
            'double_price'=>'required',
            'triple'=>'required',
            'quad'=>'required',
            'bb'=>'required',
            'lunch'=>'required',
            'dinner'=>'required',
            'full'=>'required',
            'offerd'=>'nullable',
            'valid'=>'nullable',
            'notes'=>'nullable',
            'googleMap'=>'nullable',
        ]);
        $hotelInfo = new HotelInfo();
        $hotelInfo->package_info_id = 1;
        $hotelInfo->name = $request->name;
        $hotelInfo->city = $request->city;
        $hotelInfo->type = $request->type;
        $hotelInfo->code = $request->code;
        $hotelInfo->distance = $request->distance;
        $hotelInfo->double_price = $request->double_price;
        $hotelInfo->triple = $request->triple;
        $hotelInfo->quad = $request->quad;
        $hotelInfo->bb = $request->bb;
        $hotelInfo->lunch = $request->lunch;
        $hotelInfo->dinner = $request->dinner;
        $hotelInfo->full = $request->full;
        $hotelInfo->offerd = $request->offerd;
        $hotelInfo->valid = $request->valid;
        $hotelInfo->notes = $request->notes;
        $hotelInfo->googleMap = $request->googleMap;

        $hotelInfo->save();

        return redirect()->route('hotel.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HotelInfo  $hotelInfo
     * @return \Illuminate\Http\Response
     */
    public function show(HotelInfo $hotelInfo)
    {
        //
    }

    public function getinfo($city, $packageInfo_id){
        return HotelInfo::where('city',$city)->where('package_info_id',$packageInfo_id)->get();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HotelInfo  $hotelInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(HotelInfo $hotelInfo)
    {
        $packageInfos = PackageInfo::all();

        return view('hotel.create', compact('hotelInfo', 'packageInfos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HotelInfo  $hotelInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HotelInfo $hotelInfo)
    {
        $request->validate([
            'name'=>'required',
            'city'=>'required',
            'type'=>'required',
            'code'=>'required',
            'distance'=>'required',
            'double_price'=>'required',
            'triple'=>'required',
            'quad'=>'required',
            'bb'=>'required',
            'lunch'=>'required',
            'dinner'=>'required',
            'full'=>'required',
            'offerd'=>'nullable',
            'valid'=>'nullable',
            'notes'=>'nullable',
            'googleMap'=>'nullable',
        ]);
        $hotelInfo->package_info_id = $request->package_info_id;
        $hotelInfo->name = $request->name;
        $hotelInfo->city = $request->city;
        $hotelInfo->type = $request->type;
        $hotelInfo->code = $request->code;
        $hotelInfo->distance = $request->distance;
        $hotelInfo->double_price = $request->double_price;
        $hotelInfo->triple = $request->triple;
        $hotelInfo->quad = $request->quad;
        $hotelInfo->bb = $request->bb;
        $hotelInfo->lunch = $request->lunch;
        $hotelInfo->dinner = $request->dinner;
        $hotelInfo->full = $request->full;
        $hotelInfo->offerd = $request->offerd;
        $hotelInfo->valid = $request->valid;
        $hotelInfo->notes = $request->notes;
        $hotelInfo->googleMap = $request->googleMap;

        $hotelInfo->save();

        return redirect()->route('hotel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HotelInfo  $hotelInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(HotelInfo $hotelInfo)
    {
        $hotelInfo->delete();
        return redirect()->route('hotel.index');
    }
}
