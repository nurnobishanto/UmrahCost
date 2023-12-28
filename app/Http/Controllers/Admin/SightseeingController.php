<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\Sightseeing;
use App\Models\Package;
use Yajra\DataTables\Facades\DataTables;
use Brian2694\Toastr\Facades\Toastr;

class SightseeingController extends Controller
{
    public function index(Request $request)
    {
        if(!check_permission('Sightseeing List')){
            abort(403);
        }
        if ($request->ajax()) {
            $data =  Sightseeing::with('location')->get();

            return datatables::of($data)
                ->addColumn('name', function ($data) {
                    return $data->name ?? '';
                })->addColumn('location', function ($data) {
                    return $data?->location?->name.' ('.$data?->location?->package?->name.' )';
                })->addColumn('cost', function ($data) {
                    return $data?->cost ?? '';
                })->addColumn('status', function ($data) {
                    $statusHtml = ' <label class="toggle">';
                    if ($data->status == 0) {
                        $statusHtml .= '<input onclick="change_status(\'' . $data->id . '\',\'' . $data->status . '\',\'' . route('admin.sightseeing.status.change') . '\')" class="toggle-checkbox" type="checkbox" >';
                    } elseif ($data->status == 1) {
                        $statusHtml .= '<input onclick="change_status(\'' . $data->id . '\',\'' . $data->status . '\',\'' . route('admin.sightseeing.status.change') . '\')" class="toggle-checkbox" type="checkbox" checked >';
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
                    if(check_permission('Sightseeing Edit')){
                        $actionHtml .= ' <a href="' . route('admin.sightseeing.edit', $data->id) . '">
                                            <i class="far fa-edit bg-info"></i>
                                        </a>';
                    }
                    if(check_permission('Sightseeing Delete')){
                        $actionHtml .= ' <a href="#" id="helper_delete'.$data->id.'"  onclick="delete_function('.$data->id.')" value="' . route('admin.sightseeing.destroy', $data->id) . '">
                                            <i class="fa fa-trash bg-lightdanger"></i>
                                        </a>';
                    }

                    $actionHtml .= '</div>
                                    </div> ';
                    return $actionHtml;
                })
                ->rawColumns(['name','location','cost','status','action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.sightseeing.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!check_permission('Sightseeing Create')){
            abort(403);
        }
        $locations = Location::with('package')->where('status', 1)->get();

        return view('admin.sightseeing.create',compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!check_permission('Sightseeing Create')){
            abort(403);
        }
        $request->validate([
            'name' => 'required|min:3|max:100',
            'location' => 'required|exists:locations,id',
            'cost' => 'required'
        ]);

        $sightseeing = new Sightseeing();
        $sightseeing->name = $request->name;
        $sightseeing->cost = $request->cost;
        $sightseeing->location_id = $request->location;
        $sightseeing->status = 1;

        try {
            $sightseeing->save();
            Toastr::success('Sightseeing added successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
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
        if(!check_permission('Sightseeing View')){
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
        if(!check_permission('Sightseeing Edit')){
            abort(403);
        }
        $locations = Location::with('package')->where('status', 1)->get();
        $sightseeing = Sightseeing::findOrFail($id);
        
        return view('admin.sightseeing.edit', compact('locations','sightseeing'));
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
        if(!check_permission('Sightseeing Edit')){
            abort(403);
        }
        $sightseeing = Sightseeing::findOrFail($id);
        $request->validate([
            'name' => 'required|min:3|max:100',
            'location' => 'required|exists:locations,id',
            'cost' => 'required'
        ]);

        $sightseeing->name = $request->name;
        $sightseeing->cost = $request->cost;
        $sightseeing->location_id = $request->location;
        $sightseeing->save();
        try {
            $sightseeing->save();
            Toastr::success('Sightseeing updated successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
            return redirect()->route('admin.sightseeing.index');
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
        if(!check_permission('Sightseeing Delete')){
            return response()->json([
                'type' => 'error',
                'message' => 'Whoops .You don\'t have this permission !',
            ]);
        }
        $sightseeing = Sightseeing::findOrFail($id);
        try {

            $sightseeing->delete();
            return response()->json([
                'type' => 'success',
                'message' => 'Sightseeing deleted successfully !',
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
        if(!check_permission('Sightseeing Edit')){
            return response()->json([
                'type' => 'error',
                'message' => 'Whoops .You don\'t have this permission !',
            ]);
        }
        $request->validate([
            'id' => 'required|exists:sightseeings,id',
        ]);
        $sightseeing = Sightseeing::find($request->input('id'));
        if ($sightseeing->status == 1) {
            $sightseeing->status = 0;
        } else {
            $sightseeing->status = 1;
        }
        try {
            $sightseeing->save();
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
