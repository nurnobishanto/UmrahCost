<?php

namespace App\Http\Controllers;

use App\Models\FlightInfo;
use Illuminate\Http\Request;

class FlightInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flightInfos=FlightInfo::all();
        return view('flight-info.index', compact('flightInfos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('flight-info.create');
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
            'cost'=>'required',
        ]);
        $FlightInfo = new FlightInfo;
        $FlightInfo->name = $request->name;
        $FlightInfo->cost = $request->cost;
        $FlightInfo->refund = 1;
        $FlightInfo->save();

        return redirect()->route('flightInfo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FlightInfo  $flightInfo
     * @return \Illuminate\Http\Response
     */
    public function show(FlightInfo $flightInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FlightInfo  $flightInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(FlightInfo $flightInfo)
    {
        return view('flight-info.edit', compact('flightInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FlightInfo  $flightInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FlightInfo $flightInfo)
    {
        // dd($request->all());
        $flightInfo->name = $request->name;
        $flightInfo->cost = $request->cost;
        $flightInfo->refund = 1;
        $flightInfo->save();

        return redirect()->route('flightInfo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FlightInfo  $flightInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlightInfo $flightInfo)
    {
        $flightInfo->delete();
        return redirect()->route('flightInfo.index');
    }
}
