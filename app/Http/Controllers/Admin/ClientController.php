<?php

namespace App\Http\Controllers\Admin;


use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use App\Mail\SentCredentialAfterCreateUserMail;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Airline;
use App\Models\ClientFeedback;
use App\Models\ClientSource;
use App\Models\ClientStatus;
use App\Models\Location;
use App\Models\Package;
use App\Models\PackageType;
use App\Models\QueryAbout;
use App\Models\Status;
use App\Models\Transport;
use App\Models\CustomPackage;
use App\Models\CustomPackageGuide;
use App\Models\CustomPackageHotel;
use App\Models\Guide;
use App\Models\RoomType;
use App\Models\Sightseeing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        if(!check_permission('Client List')){
            abort(403);
        }

        $show = $request->filled('show') ? $request->show : 10;
        $clients   = User::query()
                        ->when($request->filled('table_search'), function ($query) use ($request) {
                            $query->where('name', 'LIKE','%' . $request->table_search . '%')->orWhere('phone', 'LIKE','%' . $request->table_search . '%')->orWhere('email', 'LIKE','%' . $request->table_search . '%');
                        })
                        ->when($request->filled('client_status_id'), function ($query) use ($request) {
                            $query->where('client_status_id',$request->client_status_id);
                         })
                        ->where('user_type', 'client')->orderBy('name', 'ASC')
                        ->with(['customStatus','clientStatus','crm'])
                        ->paginate($show);
        $clientStatuses = ClientStatus::where('status',1)->get();

        return view('admin.client.index', compact('clients','clientStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!check_permission('Client Create')){
            abort(403);
        }
        $queryAbouts = QueryAbout::where('status',1)->get();
        $statuses = Status::where('status',1)->get();
        $clientStatuses = ClientStatus::where('status',1)->get();
        $clientFeedbacks = ClientFeedback::where('status',1)->get();
        $clientSources = ClientSource::where('status',1)->get();
        $crms = User::where([['status',1],['user_type','crm']])->get();

        return view('admin.client.create',compact('queryAbouts','statuses','clientStatuses','clientFeedbacks','clientSources','crms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!check_permission('Client Create')){
            abort(403);
        }
        $request->validate([
            'name' => 'required|min:1|max:200',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'address' => 'nullable',
            'query_details' => 'nullable',
            'notes' => 'nullable',
            'query_about' => 'nullable',
            'client_source' => 'nullable',
            'client_feedback' => 'nullable',
            'crm' => 'nullable',
            'status' => 'nullable',
            'client_status' => 'nullable',
            'tour_month' => 'required',
            'password' => 'nullable',
        ]);

        $password = $request->password ?? '12345678';

        $user                   = new User();
        $user->name             = $request->name;
        $user->email            = $request->email;
        $user->phone            = $request->phone;
        $user->address          = $request->address;
        $user->query_details    = $request->query_details;
        $user->notes            = $request->notes;
        $user->number_of_person = $request->number_of_person ?? null;
        $user->tour_month       = $request->tour_month;
        $user->user_type        = 'client';
        $user->password         = Hash::make($password);
        $user->status           = 1;

        $user->query_about_id   = $request->query_about;
        $user->client_source_id = $request->client_source;
        $user->client_feedback_id = $request->client_feedback;
        $user->crm_id           = $request->crm;
        $user->status_id        = $request->status;
        $user->client_status_id = $request->client_status;


        if ($request->hasFile('avatar')) {
            $image             = $request->file('avatar');
            $folder_path       = 'uploads/images/avatar/';
            $image_new_name    = Str::random(10) . '-' . time() . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name);
            $user->avatar =  $folder_path . $image_new_name;
        }

        try {
            $user->save();

            $url = 'https://zamzam.amarsolution.com/login';
            $subject = 'Your Credentials of Zamzam Travels';

            Mail::to($user?->email)->send(new SentCredentialAfterCreateUserMail($url, $subject, $user, $password));

            Toastr::success('Client added successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
            return back()->with('play_audio', true);
        } catch (\Exception $exception) {
            Toastr::error('Whoops .Something went wrong!' . $exception->getMessage(), 'Error', ["positionClass" => "toast-top-center","timeOut" => "2500"]);
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!check_permission('Client View')){
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!check_permission('Client Edit')){
            abort(403);
        }
        $queryAbouts = QueryAbout::where('status',1)->get();
        $statuses = Status::where('status',1)->get();
        $clientStatuses = ClientStatus::where('status',1)->get();
        $clientFeedbacks = ClientFeedback::where('status',1)->get();
        $clientSources = ClientSource::where('status',1)->get();
        $crms = User::where([['status',1],['user_type','crm']])->get();
        $user = User::findOrFail($id);

        return view('admin.client.edit', compact('user','crms','clientSources','clientFeedbacks','clientStatuses','statuses','queryAbouts'));
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
        if(!check_permission('Client Edit')){
            abort(403);
        }
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|min:1|max:200',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'required|unique:users,phone,'.$user->id,
            'address' => 'nullable',
            'query_details' => 'nullable',
            'notes' => 'nullable',
            'query_about' => 'nullable',
            'client_source' => 'nullable',
            'client_feedback' => 'nullable',
            'crm' => 'nullable',
            'status' => 'nullable',
            'client_status' => 'nullable',
            'number_of_person' => 'required',
            'tour_month' => 'required',
            'password' => 'nullable',
        ]);

        $user->name             = $request->name;
        $user->email            = $request->email;
        $user->phone            = $request->phone;
        $user->address          = $request->address;
        $user->query_details    = $request->query_details;
        $user->notes            = $request->notes;
        $user->number_of_person = $request->number_of_person;
        $user->tour_month       = $request->tour_month;

        $user->query_about_id   = $request->query_about;
        $user->client_source_id = $request->client_source;
        $user->client_feedback_id = $request->client_feedback;
        $user->crm_id           = $request->crm;
        $user->status_id        = $request->status;
        $user->client_status_id = $request->client_status;
        $user->otp_verified     = true;

        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        if ($request->hasFile('avatar')) {
            if ($user->avatar != null){
                File::delete(public_path($user->avatar)); //Old image delete
            }
            $image             = $request->file('avatar');
            $folder_path       = 'uploads/images/avatar/';
            $image_new_name    = Str::random(10) . '-' . time() . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name);
            $user->avatar =  $folder_path . $image_new_name;
        }
        try {
            $user->save();
            Toastr::success('Client updated successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
            return redirect()->route('admin.client.index');
        } catch (\Exception $exception) {
            Toastr::error('Whoops .Something went wrong!' . $exception->getMessage(), 'Error', ["positionClass" => "toast-top-center","timeOut" => "2500"]);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!check_permission('Client Delete')){
            return response()->json([
                'type' => 'error',
                'message' => 'Whoops .You don\'t have this permission !',
            ]);
        }
        $user = User::findOrFail($id);
        try {
            if ($user->avatar != null){
                File::delete(public_path($user->avatar)); //Old image delete
            }
            $user->delete();
            return response()->json([
                'type' => 'success',
                'message' => 'Client deleted successfully !',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => $exception->getMessage(),
            ]);
        }
    }

    // this method used for update user status active or inactive
    // public function statusChange(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required|exists:users,id',
    //     ]);
    //     $user = User::find($request->input('id'));
    //     if ($user->status == 1) {
    //         $user->status = 0;
    //     } else {
    //         $user->status = 1;
    //     }
    //     try {
    //         $user->save();
    //         return response()->json([
    //             'type' => 'success',
    //             'message' => 'Status changed successfully.',
    //         ]);
    //     } catch (\Exception $exception) {
    //         return response()->json([
    //             'type' => 'error',
    //             'message' => 'Whoops .Something went wrong!' . $exception->getMessage(),
    //         ]);
    //     }
    // }

    public function packageCreate($client_id){
        if(!check_permission('Client To Package Create')){
            abort(403);
        }
        $roomType = RoomType::all();
        $travelers = RoomType::orderBy('nos_of_traveler', 'asc')
            ->distinct()
            ->pluck('nos_of_traveler');
        $earliestFromDate = $roomType->min('from_date');
        $latestToDate = $roomType->max('to_date');
        $today = Carbon::today()->addDays(1)->format('Y-m-d');
        $afterSevenDays = Carbon::today()->addDays(8)->format('Y-m-d');
        $user = User::find($client_id);
        $package_id = 1;

        $packageTypes = PackageType::where([['status', 1], ['package_id', $package_id]])->get();
        $airlines = Airline::where([['status', 1], ['package_id', $package_id]])->get();
        $locations = Location::with(['hotels','sightseeings'])->where([['status', 1], ['package_id', $package_id]])->get();
        $transports = Transport::where([['status', 1], ['package_id', $package_id]])->get();
        $guides = Guide::where([['status', 1], ['package_id', $package_id]])->get();

        return view('admin.client.packageCreate', compact('user','packageTypes','airlines','locations','transports','guides','travelers','earliestFromDate','latestToDate','today','afterSevenDays'));
    }

    public function packageStore(Request $request , $client_id){
        if(!check_permission('Client To Package Create')){
            abort(403);
        }
        return $request;
        $request->validate([
            'package_type' => [
                'required',
                Rule::exists('package_types', 'id'),
            ],
            'package_id' => [
                'required',
                Rule::exists('packages', 'id'),
            ],
            'from_travel_date'       => 'required',
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
            'total_stay' => [
                'required',
            ],
            'visa'          => 'required',
            'food'          => 'required',
            'note'          => 'nullable',
        ]);

        DB::beginTransaction();

        try {

            $package = Package::find($request->package_id);

            $customPackage = new CustomPackage();
            $customPackage->client_id               = $client_id;
            $customPackage->package_type_id         = $request->package_type;
            $customPackage->airline_id              = $request->airline;
            $customPackage->from_travel_date             = Carbon::parse($request->from_travel_date);
            $customPackage->travel_date             = Carbon::parse($request->travel_date);
            $customPackage->total_stay              = $request->total_stay;
            $customPackage->note                    = $request->note;
            $customPackage->nos_of_traveler         = $request->nos_of_traveler;
            $customPackage->ip_address              = $request->ip();
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
                    $customPackageHotel->sightseeing_id = $request->sightseeing[$key];
                    $sightseeing = Sightseeing::find($request->sightseeing[$key]);
                    $customPackageHotel->sightseeing_cost = $sightseeing?->cost;
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

            if($request->guide && count($request->guide)){
                foreach ($request->guide as $key => $guide_id) {
                    if ($request->guide_included == 1) {
                        $guide = Guide::find($guide_id);

                        if($guide){
                            $customPackageGuide                     = new CustomPackageGuide();
                            $customPackageGuide->guide_id = $guide_id;
                            $customPackageGuide->guide_cost = $guide?->cost;
                            $customPackageGuide->custom_package_id  = $customPackage->id;
                            $customPackageGuide->save();
                        }
                    }
                }
            }

            DB::commit();
            return back()->with('success', 'Package created successfully .');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('warning', 'Whoops ! Something went wrong.' . $exception->getMessage());
        }
    }
}
