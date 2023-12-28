<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\ServiceVoucher;
use App\Models\ServiceVoucherSetting;
use App\Models\User;
use App\Models\VoucherAccommodation;
use App\Models\VoucherCompany;
use App\Models\VoucherFlightDetails;
use App\Models\VoucherGuest;
use App\Models\VoucherTransportation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class ServiceVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!check_permission('Service Voucher List')) {
            abort(403);
        }
        $show = $request->filled('show') ? $request->show : 10;
        $from       = '';
        $to         = '';

        if ($request->datetimes) {
            $dt_range   = explode('-', $request->datetimes);
            $from       = Carbon::createFromFormat('d/m/Y', trim($dt_range[0]))->format('y-m-d');
            $to         = Carbon::createFromFormat('d/m/Y', trim($dt_range[1]))->format('y-m-d');
        }

        $serviceVouchers = ServiceVoucher::with([
            'voucherAccommodations',
            'voucherCompanies',
            'voucherFlightDetails',
            'voucherGuests',
            'voucherTransportations'
        ])
            ->withCount([
                'voucherGuests'
            ])
            ->when($request->filled('datetimes'), function ($query) use ($from, $to) {
                $query->whereBetween('created_at', [$from, $to]);
            })
            ->when($request->filled('client_id'), function ($query) use ($request) {
                $query->where('client_id', $request->client_id);
            })
            ->when($request->filled('package_id'), function ($query) use ($request) {
                $query->where('package_id', $request->package_id);
            })
            ->orderBy('id', 'DESC')->paginate($show);

        $clients = User::where('user_type', 'client')->select('id', 'name')->get();
        $packages = Package::where('status', 1)->select('id', 'name')->get();

        return view('admin.serviceVoucher.index', compact('serviceVouchers', 'clients', 'packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!check_permission('Service Voucher Create')) {
            abort(403);
        }
        $serviceVoucherSetting = ServiceVoucherSetting::firstOrCreate();
        $clients = User::where('user_type', 'client')->select('id', 'name')->get();

        return view('admin.serviceVoucher.create', compact('clients', 'serviceVoucherSetting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!check_permission('Service Voucher Create')) {
            abort(403);
        }

        try {
            DB::beginTransaction();

            $serviceVoucher = new ServiceVoucher();

            $serviceVoucher->client_id = $request->client;
            $serviceVoucher->serial_no = $request->serial_no;
            $serviceVoucher->service_included = $request->service_included;
            $serviceVoucher->service_excluded = $request->service_excluded;
            $serviceVoucher->support_staf = $request->support_staf;
            $serviceVoucher->terms_and_conditions = $request->terms_and_conditions;

            $serviceVoucher->helpline_location = $request->helpline_location ? json_encode($request->helpline_location) : [];
            $serviceVoucher->helpline_number = $request->helpline_number ? json_encode($request->helpline_number) : [];
            $serviceVoucher->save();

            // company details store
            if ($request->company_title && count($request->company_title)) {
                foreach ($request->company_title as $key => $company_title) {
                    $voucherCompany = new VoucherCompany();
                    $voucherCompany->service_voucher_id = $serviceVoucher->id;
                    $voucherCompany->company_title = $company_title;
                    $voucherCompany->company_name = $request->company_name[$key] ? $request->company_name[$key] : null;
                    $voucherCompany->save();
                }
            }

            // voucher guest store
            if ($request->guest_name && count($request->guest_name)) {
                foreach ($request->guest_name as $key => $guest_name) {
                    $voucherGuest = new VoucherGuest();
                    $voucherGuest->service_voucher_id = $serviceVoucher->id;
                    $voucherGuest->name = $guest_name;
                    $voucherGuest->passport_no = $request->passport_no[$key] ? $request->passport_no[$key] : null;
                    $voucherGuest->save();
                }
            }

            // voucher accommodation store
            if ($request->city && count($request->city)) {
                foreach ($request->city as $key => $city) {
                    $voucherAccommodation = new VoucherAccommodation();
                    $voucherAccommodation->service_voucher_id = $serviceVoucher->id;
                    $voucherAccommodation->city = $city;
                    $voucherAccommodation->hotel = ($request->hotel && $request->hotel[$key]) ? $request->hotel[$key] : null;
                    $voucherAccommodation->room_type = ($request->room_type && $request->room_type[$key]) ? $request->room_type[$key] : null;
                    $voucherAccommodation->room = ($request->room && $request->room[$key]) ? $request->room[$key] : null;
                    $voucherAccommodation->check_in = ($request->check_in && $request->check_in[$key]) ? $request->check_in[$key] : null;
                    $voucherAccommodation->check_out = ($request->check_out && $request->check_out[$key]) ? $request->check_out[$key] : null;
                    $voucherAccommodation->night = ($request->night && $request->night[$key]) ? $request->night[$key] : null;
                    $voucherAccommodation->hotel_by = ($request->hotel_by && $request->hotel_by[$key]) ? $request->hotel_by[$key] : null;
                    $voucherAccommodation->confirm = ($request->confirm && $request->confirm[$key]) ? $request->confirm[$key] : null;
                    $voucherAccommodation->meals = ($request->meals && $request->meals[$key]) ? $request->meals[$key] : null;
                    $voucherAccommodation->save();
                }
            }

            // voucher transportation store
            if ($request->transport_date && count($request->transport_date)) {
                foreach ($request->transport_date as $key => $transport_date) {
                    $voucherTransportation = new VoucherTransportation();
                    $voucherTransportation->service_voucher_id = $serviceVoucher->id;
                    $voucherTransportation->date = Carbon::parse($transport_date);
                    $voucherTransportation->from = ($request->transport_from && $request->transport_from[$key]) ? $request->transport_from[$key] : null;
                    $voucherTransportation->from_location = ($request->from_location && $request->from_location[$key]) ? $request->from_location[$key] : null;
                    $voucherTransportation->to = ($request->transport_to && $request->transport_to[$key]) ? $request->transport_to[$key] : null;
                    $voucherTransportation->to_location = ($request->to_location && $request->to_location[$key]) ? $request->to_location[$key] : null;
                    $voucherTransportation->movement = ($request->movement && $request->movement[$key]) ? $request->movement[$key] : null;
                    $voucherTransportation->vehicle = ($request->vehicle && $request->vehicle[$key]) ? $request->vehicle[$key] : null;
                    $voucherTransportation->qty = ($request->qty && $request->qty[$key]) ? $request->qty[$key] : null;
                    $voucherTransportation->transport = ($request->transport && $request->transport[$key]) ? $request->transport[$key] : null;
                    $voucherTransportation->save();
                }
            }

            // voucher flight details store
            if ($request->career && count($request->career)) {
                foreach ($request->career as $key => $career) {
                    $voucherFlightDetails = new VoucherFlightDetails();
                    $voucherFlightDetails->service_voucher_id = $serviceVoucher->id;
                    $voucherFlightDetails->career = $career;
                    $voucherFlightDetails->flight_no = ($request->flight_no && $request->flight_no[$key]) ? $request->flight_no[$key] : null;
                    $voucherFlightDetails->from = ($request->from && $request->from[$key]) ? $request->from[$key] : null;
                    $voucherFlightDetails->to = ($request->to && $request->to[$key]) ? $request->to[$key] : null;
                    $voucherFlightDetails->etd = ($request->etd && $request->etd[$key]) ? $request->etd[$key] : null;
                    $voucherFlightDetails->eta = ($request->eta && $request->eta[$key]) ? $request->eta[$key] : null;
                    $voucherFlightDetails->save();
                }
            }

            DB::commit();
            Toastr::success('Service Voucher Stored !', 'Success', ["positionClass" => "toast-top-right", "timeOut" => "2500"]);
        } catch (\Exception $exception) {
            DB::rollback();
            Toastr::error('Whoops .Something went wrong!' . $exception->getMessage(), 'Error', ["positionClass" => "toast-top-center", "timeOut" => "2500"]);
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
        if (!check_permission('Service Voucher Edit')) {
            abort(403);
        }
        $serviceVoucher = ServiceVoucher::with([
            'voucherAccommodations',
            'voucherCompanies',
            'voucherFlightDetails',
            'voucherGuests',
            'voucherTransportations'
        ])->findOrFail($id);

        $clients = User::where('user_type', 'client')->select('id', 'name')->get();

        return view('admin.serviceVoucher.edit', compact('clients', 'serviceVoucher'));
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
        if (!check_permission('Service Voucher Edit')) {
            abort(403);
        }

        try {
            DB::beginTransaction();

            $serviceVoucher = ServiceVoucher::findOrFail($id);

            $serviceVoucher->client_id = $request->client;
            $serviceVoucher->serial_no = $request->serial_no;
            $serviceVoucher->service_included = $request->service_included;
            $serviceVoucher->service_excluded = $request->service_excluded;
            $serviceVoucher->support_staf = $request->support_staf;
            $serviceVoucher->terms_and_conditions = $request->terms_and_conditions;

            $serviceVoucher->helpline_location = $request->helpline_location ? json_encode($request->helpline_location) : [];
            $serviceVoucher->helpline_number = $request->helpline_number ? json_encode($request->helpline_number) : [];
            $serviceVoucher->save();

            // company details store
            if ($request->company_title && count($request->company_title)) {
                foreach ($request->company_title as $key => $company_title) {
                    if($request->company_ids && array_key_exists($key , $request->company_ids)){
                        $voucherCompany = VoucherCompany::find($request->company_ids[$key]);
                    }else{
                        $voucherCompany = new VoucherCompany();
                    }
                    $voucherCompany->service_voucher_id = $serviceVoucher->id;
                    $voucherCompany->company_title = $company_title;
                    $voucherCompany->company_name = $request->company_name[$key] ? $request->company_name[$key] : null;
                    $voucherCompany->save();
                }
            }

            // voucher guest store
            if ($request->guest_name && count($request->guest_name)) {
                foreach ($request->guest_name as $key => $guest_name) {
                    if($request->guest_ids && array_key_exists($key , $request->guest_ids)){
                        $voucherGuest = VoucherGuest::find($request->guest_ids[$key]);
                    }else{
                        $voucherGuest = new VoucherGuest();
                    }
                    $voucherGuest->service_voucher_id = $serviceVoucher->id;
                    $voucherGuest->name = $guest_name;
                    $voucherGuest->passport_no = $request->passport_no[$key] ? $request->passport_no[$key] : null;
                    $voucherGuest->save();
                }
            }

            // voucher accommodation store
            if ($request->city && count($request->city)) {
                foreach ($request->city as $key => $city) {
                    if($request->accommodation_ids && array_key_exists($key , $request->accommodation_ids)){
                        $voucherAccommodation = VoucherAccommodation::find($request->accommodation_ids[$key]);
                    }else{
                        $voucherAccommodation = new VoucherAccommodation();
                    }
                    $voucherAccommodation->service_voucher_id = $serviceVoucher->id;
                    $voucherAccommodation->city = $city;
                    $voucherAccommodation->hotel = ($request->hotel && $request->hotel[$key]) ? $request->hotel[$key] : null;
                    $voucherAccommodation->room_type = ($request->room_type && $request->room_type[$key]) ? $request->room_type[$key] : null;
                    $voucherAccommodation->room = ($request->room && $request->room[$key]) ? $request->room[$key] : null;
                    $voucherAccommodation->check_in = ($request->check_in && $request->check_in[$key]) ? $request->check_in[$key] : null;
                    $voucherAccommodation->check_out = ($request->check_out && $request->check_out[$key]) ? $request->check_out[$key] : null;
                    $voucherAccommodation->night = ($request->night && $request->night[$key]) ? $request->night[$key] : null;
                    $voucherAccommodation->hotel_by = ($request->hotel_by && $request->hotel_by[$key]) ? $request->hotel_by[$key] : null;
                    $voucherAccommodation->confirm = ($request->confirm && $request->confirm[$key]) ? $request->confirm[$key] : null;
                    $voucherAccommodation->meals = ($request->meals && $request->meals[$key]) ? $request->meals[$key] : null;
                    $voucherAccommodation->save();
                }
            }

            // voucher transportation store
            if ($request->transport_date && count($request->transport_date)) {
                foreach ($request->transport_date as $key => $transport_date) {
                    if($request->transportation_ids && array_key_exists($key , $request->transportation_ids)){
                        $voucherTransportation = VoucherTransportation::find($request->transportation_ids[$key]);
                    }else{
                        $voucherTransportation = new VoucherTransportation();
                    }
                    $voucherTransportation->service_voucher_id = $serviceVoucher->id;
                    $voucherTransportation->date = Carbon::parse($transport_date);
                    $voucherTransportation->from = ($request->transport_from && $request->transport_from[$key]) ? $request->transport_from[$key] : null;
                    $voucherTransportation->from_location = ($request->from_location && $request->from_location[$key]) ? $request->from_location[$key] : null;
                    $voucherTransportation->to = ($request->transport_to && $request->transport_to[$key]) ? $request->transport_to[$key] : null;
                    $voucherTransportation->to_location = ($request->to_location && $request->to_location[$key]) ? $request->to_location[$key] : null;
                    $voucherTransportation->movement = ($request->movement && $request->movement[$key]) ? $request->movement[$key] : null;
                    $voucherTransportation->vehicle = ($request->vehicle && $request->vehicle[$key]) ? $request->vehicle[$key] : null;
                    $voucherTransportation->qty = ($request->qty && $request->qty[$key]) ? $request->qty[$key] : null;
                    $voucherTransportation->transport = ($request->transport && $request->transport[$key]) ? $request->transport[$key] : null;
                    $voucherTransportation->save();
                }
            }

            // voucher flight details store
            if ($request->career && count($request->career)) {
                foreach ($request->career as $key => $career) {
                    if($request->flight_detail_ids && array_key_exists($key , $request->flight_detail_ids)){
                        $voucherFlightDetails = VoucherFlightDetails::find($request->flight_detail_ids[$key]);
                    }else{
                        $voucherFlightDetails = new VoucherFlightDetails();
                    }
                    $voucherFlightDetails->service_voucher_id = $serviceVoucher->id;
                    $voucherFlightDetails->career = $career;
                    $voucherFlightDetails->flight_no = ($request->flight_no && $request->flight_no[$key]) ? $request->flight_no[$key] : null;
                    $voucherFlightDetails->from = ($request->from && $request->from[$key]) ? $request->from[$key] : null;
                    $voucherFlightDetails->to = ($request->to && $request->to[$key]) ? $request->to[$key] : null;
                    $voucherFlightDetails->etd = ($request->etd && $request->etd[$key]) ? $request->etd[$key] : null;
                    $voucherFlightDetails->eta = ($request->eta && $request->eta[$key]) ? $request->eta[$key] : null;
                    $voucherFlightDetails->date = ($request->date && $request->date[$key]) ? Carbon::parse($request->date[$key]) : null;
                    $voucherFlightDetails->save();
                }
            }

            DB::commit();
            Toastr::success('Service Voucher Updated !', 'Success', ["positionClass" => "toast-top-right", "timeOut" => "2500"]);
            return redirect()->route('admin.serviceVoucher.index');
        } catch (\Exception $exception) {
            DB::rollback();
            Toastr::error('Whoops .Something went wrong!' . $exception->getMessage(), 'Error', ["positionClass" => "toast-top-center", "timeOut" => "2500"]);
            return back();
        }
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

    public function deleteElementById($type, $id, $voucher_id){        
        try {
            
            if($type == 'company'){
               $voucherCompany = VoucherCompany::findOrFail($id);
               $voucherCompany->delete();  
            }else if($type == 'guest'){
               $voucherGuest = VoucherGuest::findOrFail($id);
               $voucherGuest->delete();
            }else if($type == 'accommodation'){
               $voucherAccommodation = VoucherAccommodation::findOrFail($id);
               $voucherAccommodation->delete();
            
            }else if($type == 'transport_details'){
               $voucherTransportation = VoucherTransportation::findOrFail($id);
               $voucherTransportation->delete();
            }else if($type == 'flight_details'){
               $removeOldFlightDetail = VoucherFlightDetails::findOrFail($id);
               $removeOldFlightDetail->delete();
            }else{
                $serviceVoucher = ServiceVoucher::find($voucher_id);
                
                $helpline_locations = $serviceVoucher->helpline_location ? json_decode($serviceVoucher->helpline_location, true) : [];
                $helpline_numbers = $serviceVoucher->helpline_number ? json_decode($serviceVoucher->helpline_number, true) : [];
                if (array_key_exists($id, $helpline_locations)) {
                    unset($helpline_locations[$id]);
                }
                if (array_key_exists($id, $helpline_numbers)) {
                    unset($helpline_numbers[$id]);
                }

                $serviceVoucher->helpline_location = json_encode($helpline_locations);
                $serviceVoucher->helpline_number = json_encode($helpline_numbers);
                $serviceVoucher->save();
            }


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
