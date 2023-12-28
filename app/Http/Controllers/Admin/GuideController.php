<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use App\Models\Package;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Brian2694\Toastr\Facades\Toastr;


class GuideController extends Controller
{
    public function index(Request $request)
    {
        if(!check_permission('Guide List')){
            abort(403);
        }
        if ($request->ajax()) {
            $data =  Guide::with('package')->get();

            return datatables::of($data)
                ->addColumn('name', function ($data) {
                    return $data->name ?? '';
                })->addColumn('package', function ($data) {
                    return $data?->package?->name ?? '';
                })->addColumn('cost', function ($data) {
                    return $data?->cost ?? '';
                })->addColumn('status', function ($data) {
                    $statusHtml = ' <label class="toggle">';
                    if ($data->status == 0) {
                        $statusHtml .= '<input onclick="change_status(\'' . $data->id . '\',\'' . $data->status . '\',\'' . route('admin.guide.status.change') . '\')" class="toggle-checkbox" type="checkbox" >';
                    } elseif ($data->status == 1) {
                        $statusHtml .= '<input onclick="change_status(\'' . $data->id . '\',\'' . $data->status . '\',\'' . route('admin.guide.status.change') . '\')" class="toggle-checkbox" type="checkbox" checked >';
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
                        if(check_permission('Guide Edit')){
                            $actionHtml .= '<a href="' . route('admin.guide.edit', $data->id) . '">
                                                <i class="far fa-edit bg-info"></i>
                                            </a>';
                        }
                        if(check_permission('Guide Delete')){
                            $actionHtml .= ' <a href="#" id="helper_delete'.$data->id.'"  onclick="delete_function('.$data->id.')" value="' . route('admin.guide.destroy', $data->id) . '">
                                                <i class="fa fa-trash bg-lightdanger"></i>
                                            </a>';
                        }
                    $actionHtml .= '</div>
                                    </div> ';
                    return $actionHtml;
                })
                ->rawColumns(['name','package','cost','status','action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.guide.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!check_permission('Guide Create')){
            abort(403);
        }
        $packages = Package::where('status', 1)->get();

        return view('admin.guide.create',compact('packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!check_permission('Guide Create')){
            abort(403);
        }
        $request->validate([
            'name'      => 'required|min:3|max:100',
            'package'   => 'required|exists:packages,id',
            'cost'      => 'required'
        ]);

        $guide                = new Guide();
        $guide->name          = $request->name;
        $guide->cost          = $request->cost;
        $guide->package_id    = $request->package;
        $guide->status        = 1;

        try {
            $guide->save();
            Toastr::success('Guide added successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
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
        if(!check_permission('Guide View')){
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
        if(!check_permission('Guide Edit')){
            abort(403);
        }
        $packages = Package::where('status', 1)->get();
        $guide = Guide::findOrFail($id);
        
        return view('admin.guide.edit', compact('packages','guide'));
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
        if(!check_permission('Guide Edit')){
            abort(403);
        }
        $guide = Guide::findOrFail($id);
        $request->validate([
            'name'      => 'required|min:3|max:100',
            'package'   => 'required|exists:packages,id',
            'cost'      => 'required'
        ]);

        $guide->name          = $request->name;
        $guide->cost          = $request->cost;
        $guide->package_id    = $request->package;
        $guide->save();
        try {
            $guide->save();
            Toastr::success('Guide updated successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
            return redirect()->route('admin.guide.index');
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
        if(!check_permission('Guide Delete')){
            return response()->json([
                'type' => 'error',
                'message' => 'Whoops .You don\'t have this permission !',
            ]);
        }
        $guide = Guide::findOrFail($id);
        try {

            $guide->delete();
            return response()->json([
                'type' => 'success',
                'message' => 'Guide deleted successfully !',
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
        if(!check_permission('Guide Delete')){
            return response()->json([
                'type' => 'error',
                'message' => 'Whoops .You don\'t have this permission !',
            ]);
        }
        $request->validate([
            'id' => 'required|exists:guides,id',
        ]);
        $guide = Guide::find($request->input('id'));
        if ($guide->status == 1) {
            $guide->status = 0;
        } else {
            $guide->status = 1;
        }
        try {
            $guide->save();
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
