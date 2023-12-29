<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Location;
use App\Models\PackageType;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Brian2694\Toastr\Facades\Toastr;

class RoomTypeController extends Controller
{
    public function index(Request $request)
    {
        if(!check_permission('Room Type List')){
            abort(403);
        }
        if ($request->ajax()) {
            $data =  RoomType::with(['hotel','hotel.location','hotel.packageType'])->when($request->filled('package_type_id'), function ($query) use ($request) {
                $query->whereHas('hotel.packageType',function($q) use ($request){
                    $q->where('id',$request->package_type_id);
                });
            })->when($request->filled('location_id'), function ($q) use ($request) {
                $q->whereHas('hotel.location',function($q) use ($request){
                    $q->where('id',$request->location_id);
                });
            })->when($request->filled('hotel_id'), function ($q) use ($request) {
                $q->where('hotel_id',$request->hotel_id);
            })->get();

            return datatables::of($data)
                ->addColumn('name', function ($data) {
                    return $data->name ?? '';
                })->addColumn('nos_of_traveler', function ($data) {
                    return $data->nos_of_traveler ?? '';
                })->addColumn('cost_per_day', function ($data) {
                    return $data->cost_per_day ?? '';
                })->addColumn('hotel_name', function ($data) {
                    if($data?->hotel?->location?->name){
                        return $data?->hotel?->name .'('.$data?->hotel?->location?->name.')';
                    }else{
                        return $data?->hotel?->name;
                    }
                })->addColumn('status', function ($data) {
                    $statusHtml = ' <label class="toggle">';
                    if ($data->status == 0) {
                        $statusHtml .= '<input onclick="change_status(\'' . $data->id . '\',\'' . $data->status . '\',\'' . route('admin.roomType.status.change') . '\')" class="toggle-checkbox" type="checkbox" >';
                    } elseif ($data->status == 1) {
                        $statusHtml .= '<input onclick="change_status(\'' . $data->id . '\',\'' . $data->status . '\',\'' . route('admin.roomType.status.change') . '\')" class="toggle-checkbox" type="checkbox" checked >';
                    }
                    $statusHtml .=  '<div class="toggle-switch">
                                        <span class="on"><i class="fas fa-check"></i></span>
                                        <span class="off"><i class="fas fa-times"></i></span>
                                    </div>';
                    $statusHtml .= '</label>';
                    return $statusHtml;
                })->addColumn('action', function ($data) {
                    $actionHtml = '<div class="edit-icons">
                                        <div class ="action-buttons">
                                    ';
                    if(check_permission('Room Type Edit')){
                        $actionHtml .= ' <a href="' . route('admin.roomType.edit', $data->id) . '">
                                            <i class="far fa-edit bg-info"></i>
                                        </a>';
                    }
                    if(check_permission('Room Type Delete')){
                        $actionHtml .= ' <a href="#" id="helper_delete'.$data->id.'"  onclick="delete_function('.$data->id.')" value="' . route('admin.roomType.destroy', $data->id) . '">
                                            <i class="fa fa-trash bg-lightdanger"></i>
                                        </a>';
                    }
                    $actionHtml .= '</div>
                                    </div> ';
                    return $actionHtml;
                })
                ->rawColumns(['name','nos_of_traveler','cost_per_day','hotel_name','status', 'action'])
                ->addIndexColumn()
                ->make(true);
        }

        $packageTypes = PackageType::with('package')->where('status',1)->get();
        $locations = Location::when($request->filled('package_type_id'), function ($query) use ($request) {
            $query->whereHas('package.packageTypes',function($q) use ($request){
                $q->where('id',$request->package_type_id);
            });
        })->where('status',1)->get();
        $hotels = Hotel::when($request->filled('location_id'), function ($q) use ($request) {
            $q->where('location_id',$request->location_id);
        })->where('status',1)->get();

        return view('admin.roomType.index', compact('packageTypes','locations','hotels'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!check_permission('Room Type Create')){
            abort(403);
        }
        $hotels = Hotel::with('location')->where('status', 1)->get();

        return view('admin.roomType.create',compact('hotels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!check_permission('Room Type Create')){
            abort(403);
        }
        $request->validate([
            'name'              => 'required|min:1|max:200',
            'nos_of_traveler'   => 'required',
            'cost_per_day'      => 'required',
            'hotel'             => 'required',
            'from_date'             => 'required',
            'to_date'             => 'required',
        ]);

        $roomType                   = new RoomType();
        $roomType->name             = $request->name;
        $roomType->nos_of_traveler  = $request->nos_of_traveler;
        $roomType->cost_per_day     = $request->cost_per_day;
        $roomType->hotel_id         = $request->hotel;
        $roomType->from_date        = Carbon::createFromFormat('d/m/Y', $request->from_date)->format('Y-m-d');
        $roomType->to_date          = Carbon::createFromFormat('d/m/Y', $request->to_date)->format('Y-m-d');
        $roomType->status = 1;

        try {
            $roomType->save();
            Toastr::success('Room Type added successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
        } catch (\Exception $exception) {
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
        if(!check_permission('Room Type View')){
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
        if(!check_permission('Room Type Edit')){
            abort(403);
        }
        $roomType = RoomType::findOrFail($id);
        $hotels = Hotel::with('location')->where('status', 1)->get();

        return view('admin.roomType.edit', compact('roomType','hotels'));
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

        if(!check_permission('Room Type Edit')){
            abort(403);
        }
        $roomType = RoomType::findOrFail($id);
        $request->validate([
            'name'              => 'required|min:3|max:100',
            'nos_of_traveler'   => 'required',
            'cost_per_day'      => 'required',
            'hotel'             => 'required',
            'from_date'         => 'required',
            'to_date'           => 'required',
        ]);

        $roomType->name             = $request->name;
        $roomType->nos_of_traveler  = $request->nos_of_traveler;
        $roomType->hotel_id         = $request->hotel;
        $roomType->cost_per_day     = $request->cost_per_day;
        $roomType->from_date        = Carbon::createFromFormat('d/m/Y', $request->from_date)->format('Y-m-d');
        $roomType->to_date          = Carbon::createFromFormat('d/m/Y', $request->to_date)->format('Y-m-d');
        $roomType->save();
        try {
            $roomType->save();
            Toastr::success('Room Type updated successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
            return redirect()->route('admin.roomType.index');
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
        if(!check_permission('Room Type Delete')){
            return response()->json([
                'type' => 'error',
                'message' => 'Whoops .You don\'t have this permission !',
            ]);
        }
        $roomType = RoomType::findOrFail($id);
        try {

            $roomType->delete();
            return response()->json([
                'type' => 'success',
                'message' => 'Room Type deleted successfully !',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => $exception->getMessage(),
            ]);
        }
    }

    // this method used for update user status active or inactive
    public function statusChange(Request $request)
    {
        if(!check_permission('Room Type Edit')){
            return response()->json([
                'type' => 'error',
                'message' => 'Whoops .You don\'t have this permission !',
            ]);
        }
        $request->validate([
            'id' => 'required|exists:room_types,id',
        ]);
        $roomType = RoomType::find($request->input('id'));
        if ($roomType->status == 1) {
            $roomType->status = 0;
        } else {
            $roomType->status = 1;
        }
        try {
            $roomType->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Status changed successfully.',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => 'Whoops .Something went wrong!' . $exception->getMessage(),
            ]);
        }
    }
}
