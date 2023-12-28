<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGeneralSettingsRequest;
use App\Http\Requests\UpdateGeneralSettingsRequest;
use Illuminate\Http\Request;
use App\Models\GeneralSettings;

class GeneralSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function authorize()
    // {
    //     return true;
    // }


    public function index()
    {
        $generalSettings=GeneralSettings::all();
        return view('general-setting.index', compact('generalSettings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('general-setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGeneralSettingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'visa_cost'=>'required',
            'service_charge'=>'required',
            'conversion_rate'=>'required',
        ]);
        $generalSetting = new GeneralSettings;
        $generalSetting->visa_cost = $request->visa_cost;
        $generalSetting->service_charge = $request->service_charge;
        $generalSetting->conversion_rate = $request->conversion_rate;

        $generalSetting->save();

        return redirect()->route('generalsetting.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GeneralSettings  $generalSettings
     * @return \Illuminate\Http\Response
     */
    public function show(GeneralSettings $generalSettings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GeneralSettings  $generalSettings
     * @return \Illuminate\Http\Response
     */
    public function edit(GeneralSettings $generalSettings)
    {
        return view('general-setting.create', compact('generalSettings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGeneralSettingsRequest  $request
     * @param  \App\Models\GeneralSettings  $generalSettings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GeneralSettings $generalSettings)
    {
        // dd($request->all());
        $generalSettings->visa_cost = $request->visa_cost;
        $generalSettings->service_charge = $request->service_charge;
        $generalSettings->conversion_rate = $request->conversion_rate;

        $generalSettings->save();

        return redirect()->route('generalsetting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GeneralSettings  $generalSettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(GeneralSettings $generalSettings)
    {
        //
    }
}
