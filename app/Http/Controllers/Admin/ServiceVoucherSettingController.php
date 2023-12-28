<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceVoucherSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class ServiceVoucherSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!(check_permission('Service Voucher Setting List') || check_permission('Service Voucher Setting Create'))){
            abort(403);
        }
        $serviceVoucherSetting = ServiceVoucherSetting::firstOrCreate();
        return view('admin.serviceVoucherSetting.create', compact('serviceVoucherSetting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!check_permission('Service Voucher Setting Create')){
            abort(403);
        }
        $request->validate([
            'service_included' => 'required',
            'service_excluded' => 'required',
            'support_staf' => 'required',
            'terms_and_conditions' => 'required',

            'company_title' => 'nullable|array',
            'company_name' => 'nullable|array',
            
            'helpline_location' => 'nullable|array',
            'helpline_number' => 'nullable|array',

            'career' => 'nullable|array',
            'flight_no' => 'nullable|array',
            'from' => 'nullable|array',
            'to' => 'nullable|array',
            'etd' => 'nullable|array',
            'eta' => 'nullable|array',
        ]);

        try {
            DB::beginTransaction();

            $serviceVoucherSetting = ServiceVoucherSetting::firstOrCreate();
        
            $serviceVoucherSetting->update([
                'service_included' => $request->service_included,
                'service_excluded' => $request->service_excluded,
                'support_staf' => $request->support_staf,
                'terms_and_conditions' => $request->terms_and_conditions,
            
                'company_title' => $request->company_title ? json_encode($request->company_title) : [],
                'company_name' => $request->company_name ? json_encode($request->company_name) : [],
                
                'helpline_location' => $request->helpline_location ? json_encode($request->helpline_location) : [],
                'helpline_number' => $request->helpline_number ? json_encode($request->helpline_number) : [],
                
                'career' => $request->career ? json_encode($request->career) : [],
                'flight_no' => $request->flight_no ? json_encode($request->flight_no) : [],
                'from' => $request->from ? json_encode($request->from) : [],
                'to' => $request->to ? json_encode($request->to) : [],
                'etd' => $request->etd ? json_encode($request->etd) : [],
                'eta' => $request->eta ? json_encode($request->eta) : [],

            ]);

            DB::commit();
            Toastr::success('Service Voucher Setting Stored !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
        } catch (\Exception $exception) {
            DB::rollback();
            Toastr::error('Whoops .Something went wrong!' . $exception->getMessage(), 'Error', ["positionClass" => "toast-top-center","timeOut" => "2500"]);
        }
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function deleteElementByKey($type, $key){        
        try {
            $serviceVoucherSetting = ServiceVoucherSetting::firstOrCreate();
            
            if($type == 'company'){
                $company_titles = $serviceVoucherSetting->company_title ? json_decode($serviceVoucherSetting->company_title, true) : [];
                $company_names = $serviceVoucherSetting->company_name ? json_decode($serviceVoucherSetting->company_name, true) : [];
                if (array_key_exists($key, $company_titles)) {
                    unset($company_titles[$key]);
                }
                if (array_key_exists($key, $company_names)) {
                    unset($company_names[$key]);
                }

                $serviceVoucherSetting->company_title = json_encode($company_titles);
                $serviceVoucherSetting->company_name = json_encode($company_names);
            }else if($type == 'flight'){
                $careers = $serviceVoucherSetting->career ? json_decode($serviceVoucherSetting->career, true) : [];
                $flight_nos = $serviceVoucherSetting->flight_no ? json_decode($serviceVoucherSetting->flight_no, true) : [];
                $froms = $serviceVoucherSetting->from ? json_decode($serviceVoucherSetting->from, true) : [];
                $tos = $serviceVoucherSetting->to ? json_decode($serviceVoucherSetting->to, true) : [];
                $etds = $serviceVoucherSetting->etd ? json_decode($serviceVoucherSetting->etd, true) : [];
                $etas = $serviceVoucherSetting->eta ? json_decode($serviceVoucherSetting->eta, true) : [];

                if (array_key_exists($key, $careers)) {
                    unset($careers[$key]);
                }  
                if (array_key_exists($key, $flight_nos)) {
                    unset($flight_nos[$key]);
                }  
                if (array_key_exists($key, $froms)) {
                    unset($froms[$key]);
                }  
                if (array_key_exists($key, $tos)) {
                    unset($tos[$key]);
                }  
                if (array_key_exists($key, $etds)) {
                    unset($etds[$key]);
                }  
                if (array_key_exists($key, $etas)) {
                    unset($etas[$key]);
                }
                $serviceVoucherSetting->career = json_encode($careers);
                $serviceVoucherSetting->flight_no = json_encode($flight_nos);
                $serviceVoucherSetting->from = json_encode($froms);
                $serviceVoucherSetting->to = json_encode($tos);
                $serviceVoucherSetting->etd = json_encode($etds);
                $serviceVoucherSetting->eta = json_encode($etas);
            }else{
                $helpline_locations = $serviceVoucherSetting->helpline_location ? json_decode($serviceVoucherSetting->helpline_location, true) : [];
                $helpline_numbers = $serviceVoucherSetting->helpline_number ? json_decode($serviceVoucherSetting->helpline_number, true) : [];
                if (array_key_exists($key, $helpline_locations)) {
                    unset($helpline_locations[$key]);
                }
                if (array_key_exists($key, $helpline_numbers)) {
                    unset($helpline_numbers[$key]);
                }

                $serviceVoucherSetting->helpline_location = json_encode($helpline_locations);
                $serviceVoucherSetting->helpline_number = json_encode($helpline_numbers);
            }

            $serviceVoucherSetting->save();

            return response()->json([
                'message' => 'Deleted Successfully !',
                'status' => 200,  
            ],200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Whoops Something went wrong !'.$exception->getMessage(),
                'status' => 500,  
            ],500);
        }
    }
}
