<?php

namespace App\Http\Controllers;

use App\Models\packageRate;
use Illuminate\Http\Request;

class PackageRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packageRates=packageRate::all();
        return view('packagerate.index', compact('packageRates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('packagerate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'mak_hotel'=>'required',
            'mad_hotel'=>'required',
        ]);
        $packageRate=new packageRate();
        $packageRate->name = $request->name;
        $packageRate->mak_hotel = $request->mak_hotel;
        $packageRate->mak_hotel_desc = $request->mak_hotel_desc;
        $packageRate->mad_hotel = $request->mad_hotel;
        $packageRate->mad_hotel_desc = $request->mad_hotel_desc;

        $packageRate->save();

        return redirect()->route('package.rate.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\packageRate  $packageRate
     * @return \Illuminate\Http\Response
     */
    public function show(packageRate $packageRate)
    {
        return $packageRate;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\packageRate  $packageRate
     * @return \Illuminate\Http\Response
     */
    public function edit(packageRate $packageRate)
    {
        return view('packagerate.create', compact('packageRate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\packageRate  $packageRate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, packageRate $packageRate)
    {
        $request->validate([
            'name'=>'required',
            'mak_hotel'=>'required',
            'mad_hotel'=>'required',
        ]);
        $packageRate->name = $request->name;
        $packageRate->mak_hotel = $request->mak_hotel;
        $packageRate->mak_hotel_desc = $request->mak_hotel_desc;
        $packageRate->mad_hotel = $request->mad_hotel;
        $packageRate->mad_hotel_desc = $request->mad_hotel_desc;

        $packageRate->save();

        return redirect()->route('package.rate.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\packageRate  $packageRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(packageRate $packageRate)
    {
        $packageRate->delete();
        return redirect()->route('package.rate.index');
    }

    public function getPackageRate($package_info_id, $mak_stays, $mad_satys, $room, $flight){
        $packageRate=packageRate::where('package_info_id', $package_info_id)
        ->where('mak_stays', $mak_stays)
        ->where('mad_stays',$mad_satys)
        ->where('room', $room)
        ->where('flight', $flight)
        ->get();

        if($packageRate->isEmpty()) return array('error'=>true, 'message'=>'no Date');
        return array('error'=>false, 'data'=>$packageRate[0]);
    }
}
