<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Brian2694\Toastr\Facades\Toastr;

class PackageTypeController extends Controller
{
    public function index(Request $request)
    {
        if(!check_permission('Package Type List')){
            abort(403);
        }
        if ($request->ajax()) {
            $data =  PackageType::with('package')->get();

            return datatables::of($data)
                ->addColumn('name', function ($data) {
                    return $data->name ?? '';
                })->addColumn('package', function ($data) {
                    return $data?->package?->name ?? '';
                })->addColumn('status', function ($data) {
                    $statusHtml = ' <label class="toggle">';
                    if ($data->status == 0) {
                        $statusHtml .= '<input onclick="change_status(\'' . $data->id . '\',\'' . $data->status . '\',\'' . route('admin.packageType.status.change') . '\')" class="toggle-checkbox" type="checkbox" >';
                    } elseif ($data->status == 1) {
                        $statusHtml .= '<input onclick="change_status(\'' . $data->id . '\',\'' . $data->status . '\',\'' . route('admin.packageType.status.change') . '\')" class="toggle-checkbox" type="checkbox" checked >';
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
                    if(check_permission('Package Type Edit')){
                        $actionHtml .= ' <a href="' . route('admin.packageType.edit', $data->id) . '">
                                            <i class="far fa-edit bg-info"></i>
                                        </a>';
                    }
                    if(check_permission('Package Type Delete')){
                        $actionHtml .= ' <a href="#" id="helper_delete'.$data->id.'"  onclick="delete_function('.$data->id.')" value="' . route('admin.packageType.destroy', $data->id) . '">
                                            <i class="fa fa-trash bg-lightdanger"></i>
                                        </a>';
                    }
                    $actionHtml .= '</div>
                                    </div> ';
                    return $actionHtml;
                })
                ->rawColumns(['name','package','status','action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.packageType.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!check_permission('Package Type Create')){
            abort(403);
        }
        $packages = Package::where('status', 1)->get();
        return view('admin.packageType.create',compact('packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!check_permission('Package Type Create')){
            abort(403);
        }
        $request->validate([
            'name' => 'required|min:1|max:200',
            'package' => 'required|exists:packages,id',
        ]);

        $packageType = new PackageType();
        $packageType->name = $request->name;
        $packageType->package_id = $request->package;
        $packageType->status = 1;

        try {
            $packageType->save();
            Toastr::success('Package Type added successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
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
        if(!check_permission('Package Type View')){
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
        if(!check_permission('Package Type Edit')){
            abort(403);
        }
        $packages = Package::where('status', 1)->get();
        $packageType = PackageType::findOrFail($id);
        return view('admin.packageType.edit', compact('packageType','packages'));
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
        if(!check_permission('Package Type Edit')){
            abort(403);
        }
        $packageType = PackageType::findOrFail($id);
        $request->validate([
            'name' => 'required|min:3|max:100',
            'package' => 'required|exists:packages,id',
        ]);

        $packageType->name = $request->name;
        $packageType->package_id = $request->package;
        $packageType->save();
        try {
            $packageType->save();
            Toastr::success('Package Type updated successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
            return redirect()->route('admin.packageType.index');
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
        if(!check_permission('Package Type Delete')){
            abort(403);
        }
        $packageType = PackageType::findOrFail($id);
        try {

            $packageType->delete();
            return response()->json([
                'type' => 'success',
                'message' => 'Package Type deleted successfully !',
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
        if(!check_permission('Package Type Edit')){
            abort(403);
        }
        $request->validate([
            'id' => 'required|exists:package_types,id',
        ]);
        $packageType = PackageType::find($request->input('id'));
        if ($packageType->status == 1) {
            $packageType->status = 0;
        } else {
            $packageType->status = 1;
        }
        try {
            $packageType->save();
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
