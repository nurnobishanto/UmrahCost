<?php

namespace App\Http\Controllers;

use App\Models\PackageInfo;
use Illuminate\Http\Request;

class PackageInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packageInfos=PackageInfo::all();
        return view('packageInfo.index', compact('packageInfos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('packageInfo.create');
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
        $packageInfo=new PackageInfo();
        $packageInfo->name = $request->name;
        $packageInfo->mak_hotel = $request->mak_hotel;
        $packageInfo->mak_hotel_desc = $request->mak_hotel_desc;
        $packageInfo->mad_hotel = $request->mad_hotel;
        $packageInfo->mad_hotel_desc = $request->mad_hotel_desc;

        $packageInfo->save();

        return redirect()->route('packageinfo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\packageRate  $packageInfo
     * @return \Illuminate\Http\Response
     */
    public function show(PackageInfo $packageInfo)
    {
        return $packageInfo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\packageRate  $packageInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(PackageInfo $packageInfo)
    {
        return view('packageInfo.create', compact('packageInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\packageRate  $packageInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PackageInfo $packageInfo)
    {
        $request->validate([
            'name'=>'required',
            'mak_hotel'=>'required',
            'mad_hotel'=>'required',
        ]);
        $packageInfo->name = $request->name;
        $packageInfo->mak_hotel = $request->mak_hotel;
        $packageInfo->mak_hotel_desc = $request->mak_hotel_desc;
        $packageInfo->mad_hotel = $request->mad_hotel;
        $packageInfo->mad_hotel_desc = $request->mad_hotel_desc;

        $packageInfo->save();

        return redirect()->route('packageinfo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\packageRate  $packageInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackageInfo $packageInfo)
    {
        $packageInfo->delete();
        return redirect()->route('packageinfo.index');
    }
}
