<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Location;
use App\Models\PackageType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Brian2694\Toastr\Facades\Toastr;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        if(!check_permission('Hotel List')){
            abort(403);
        }
        if ($request->ajax()) {

            $data =  Hotel::when($request->filled('package_type_id'), function ($query) use ($request) {
                $query->where('package_type_id',$request->package_type_id);
             })->when($request->filled('location_id'), function ($query) use ($request) {
                $query->where('location_id',$request->location_id);
             })->get();

            return datatables::of($data)
                ->addColumn('name', function ($data) {
                    return $data->name ?? '';
                })->addColumn('package_type', function ($data) {
                    return $data?->packageType?->name .' ('. $data?->packageType?->package?->name . ')';
                })->addColumn('location', function ($data) {
                    return  $data?->location?->name ?? '';
                })->addColumn('status', function ($data) {
                    $statusHtml = ' <label class="toggle">';
                    if ($data->status == 0) {
                        $statusHtml .= '<input onclick="change_status(\'' . $data->id . '\',\'' . $data->status . '\',\'' . route('admin.hotel.status.change') . '\')" class="toggle-checkbox" type="checkbox" >';
                    } elseif ($data->status == 1) {
                        $statusHtml .= '<input onclick="change_status(\'' . $data->id . '\',\'' . $data->status . '\',\'' . route('admin.hotel.status.change') . '\')" class="toggle-checkbox" type="checkbox" checked >';
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
                        if(check_permission('Hotel Edit')){
                            $actionHtml .= ' <a href="' . route('admin.hotel.edit', $data->id) . '">
                                                <i class="far fa-edit bg-info"></i>
                                            </a>';                
                        }
                        if(check_permission('Hotel Delete')){
                            $actionHtml .= ' <a href="#" id="helper_delete'.$data->id.'"  onclick="delete_function('.$data->id.')" value="' . route('admin.hotel.destroy', $data->id) . '">
                                                <i class="fa fa-trash bg-lightdanger"></i>
                                            </a>';
                        }
                    $actionHtml .= '</div>
                                    </div> ';
                    return $actionHtml;
                })
                ->rawColumns(['name','package_type','location','status','action'])
                ->addIndexColumn()
                ->make(true);
        }

        $packageTypes = PackageType::with('package')->where('status',1)->get();
        $locations = Location::when($request->filled('package_type_id'), function ($query) use ($request) {
            $query->whereHas('package.packageTypes',function($q) use ($request){
                $q->where('id',$request->package_type_id);
            });
        })->where('status',1)->get();
        return view('admin.hotel.index', compact('packageTypes','locations'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!check_permission('Hotel Create')){
            abort(403);
        }
        $packageTypes = PackageType::with('package')->where('status', 1)->get();
        $locations = Location::with('package')->where('status', 1)->get();
        return view('admin.hotel.create',compact('packageTypes','locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!check_permission('Hotel Create')){
            abort(403);
        }
        $request->validate([
            'name' => 'required|min:1|max:200',
            'package_type' => 'required|exists:package_types,id',
            'location' => 'required|exists:locations,id',
        ]);

        $hotel                  = new Hotel();
        $hotel->name            = $request->name;
        $hotel->package_type_id = $request->package_type;
        $hotel->location_id     = $request->location;
        $hotel->status          = 1;

        try {
            $hotel->save();
            Toastr::success('Hotel added successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
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
        if(!check_permission('Hotel View')){
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
        if(!check_permission('Hotel Edit')){
            abort(403);
        }
        $packageTypes = PackageType::with('package')->where('status', 1)->get();
        $locations = Location::with('package')->where('status', 1)->get();
        $hotel = Hotel::findOrFail($id);

        return view('admin.hotel.edit', compact('hotel','packageTypes','locations'));
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
        if(!check_permission('Hotel Edit')){
            abort(403);
        }
        $hotel = Hotel::findOrFail($id);
        $request->validate([
            'name' => 'required|min:1|max:200',
            'package_type' => 'required|exists:package_types,id',
            'location' => 'required|exists:locations,id',
        ]);

        $hotel->name            = $request->name;
        $hotel->package_type_id = $request->package_type;
        $hotel->location_id     = $request->location;
        $hotel->status          = 1;

        try {
            $hotel->save();
            Toastr::success('Hotel updated successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
            return redirect()->route('admin.hotel.index');
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
        if(!check_permission('Hotel Delete')){
            return response()->json([
                'type' => 'error',
                'message' => 'Whoops .You don\'t have this permission !',
            ]);
        }
        $hotel = Hotel::findOrFail($id);
        try {

            $hotel->delete();
            return response()->json([
                'type' => 'success',
                'message' => 'Hotel deleted successfully !',
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
        if(!check_permission('Hotel Edit')){
            return response()->json([
                'type' => 'error',
                'message' => 'Whoops .You don\'t have this permission !',
            ]);
        }
        $request->validate([
            'id' => 'required|exists:hotels,id',
        ]);
        $hotel = Hotel::find($request->input('id'));
        if ($hotel->status == 1) {
            $hotel->status = 0;
        } else {
            $hotel->status = 1;
        }
        try {
            $hotel->save();
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
