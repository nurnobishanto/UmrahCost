<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientSource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Brian2694\Toastr\Facades\Toastr;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class ClientSourceController extends Controller
{
    public function index(Request $request)
    {
        if(!check_permission('Client Source List')){
            abort(403);
        }
        if ($request->ajax()) {
            $data =  ClientSource::all();

            return datatables::of($data)
                ->addColumn('name', function ($data) {
                    return $data->name ?? '';
                })->addColumn('status', function ($data) {
                    $statusHtml = ' <label class="toggle">';
                    if ($data->status == 0) {
                        $statusHtml .= '<input onclick="change_status(\'' . $data->id . '\',\'' . $data->status . '\',\'' . route('admin.clientSource.status.change') . '\')" class="toggle-checkbox" type="checkbox" >';
                    } elseif ($data->status == 1) {
                        $statusHtml .= '<input onclick="change_status(\'' . $data->id . '\',\'' . $data->status . '\',\'' . route('admin.clientSource.status.change') . '\')" class="toggle-checkbox" type="checkbox" checked >';
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
                    if(check_permission('Client Source Edit')){
                        $actionHtml .= ' <a href="' . route('admin.clientSource.edit', $data->id) . '">
                                            <i class="far fa-edit bg-info"></i>
                                        </a>';
                        
                    }
                    if(check_permission('Client Source Delete')){
                        $actionHtml .= ' <a href="#" id="helper_delete'.$data->id.'"  onclick="delete_function('.$data->id.')" value="' . route('admin.clientSource.destroy', $data->id) . '">
                                            <i class="fa fa-trash bg-lightdanger"></i>
                                        </a>';
                    }

                    $actionHtml .= '</div>
                                    </div> ';
                    return $actionHtml;
                })
                ->rawColumns(['name', 'status', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.clientSource.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!check_permission('Client Source Create')){
            abort(403);
        }
        return view('admin.clientSource.create',);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!check_permission('Client Source Create')){
            abort(403);
        }
        $request->validate([
            'name' => 'required|min:1|max:200',
        ]);

        $clientSource = new ClientSource();
        $clientSource->name = $request->name;
        $clientSource->status = 1;

        try {
            $clientSource->save();
            Toastr::success('Client Source added successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
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
        if(!check_permission('Client Source View')){
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
        if(!check_permission('Client Source Edit')){
            abort(403);
        }
        $clientSource = ClientSource::findOrFail($id);
        return view('admin.clientSource.edit', compact('clientSource'));
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
        if(!check_permission('Client Source Edit')){
            abort(403);
        }
        $clientSource = ClientSource::findOrFail($id);
        $request->validate([
            'name' => 'required|min:3|max:100',
        ]);

        $clientSource->name = $request->name;
        $clientSource->save();
        try {
            $clientSource->save();
            Toastr::success('Client Source updated successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
            return redirect()->route('admin.clientSource.index');
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
        if(!check_permission('Client Source Delete')){
            return response()->json([
                'type' => 'error',
                'message' => 'Whoops .You don\'t have this permission !',
            ]);
        }
        $clientSource = ClientSource::findOrFail($id);
        try {

            $clientSource->delete();
            return response()->json([
                'type' => 'success',
                'message' => 'Client Source deleted successfully !',
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
        if(!check_permission('Client Source Edit')){
            return response()->json([
                'type' => 'error',
                'message' => 'Whoops .You don\'t have this permission !',
            ]);
        }
        $request->validate([
            'id' => 'required|exists:client_sources,id',
        ]);
        $clientSource = ClientSource::find($request->input('id'));
        if ($clientSource->status == 1) {
            $clientSource->status = 0;
        } else {
            $clientSource->status = 1;
        }
        try {
            $clientSource->save();
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
