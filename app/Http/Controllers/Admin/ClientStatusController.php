<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientStatus;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Brian2694\Toastr\Facades\Toastr;

class ClientStatusController extends Controller
{
    public function index(Request $request)
    {
        if(!check_permission('Client Status List')){
            abort(403);
        }
        if ($request->ajax()) {
            $data =  ClientStatus::all();

            return datatables::of($data)
                ->addColumn('name', function ($data) {
                    return $data->name ?? '';
                })->addColumn('status', function ($data) {
                    $statusHtml = ' <label class="toggle">';
                    if ($data->status == 0) {
                        $statusHtml .= '<input onclick="change_status(\'' . $data->id . '\',\'' . $data->status . '\',\'' . route('admin.clientStatus.status.change') . '\')" class="toggle-checkbox" type="checkbox" >';
                    } elseif ($data->status == 1) {
                        $statusHtml .= '<input onclick="change_status(\'' . $data->id . '\',\'' . $data->status . '\',\'' . route('admin.clientStatus.status.change') . '\')" class="toggle-checkbox" type="checkbox" checked >';
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
                    if(check_permission('Client Status Edit')){
                        $actionHtml .= ' <a href="' . route('admin.clientStatus.edit', $data->id) . '">
                                            <i class="far fa-edit bg-info"></i>
                                        </a>';
                    }
                    if(check_permission('Client Status Delete')){
                        $actionHtml .= ' <a href="#" id="helper_delete'.$data->id.'"  onclick="delete_function('.$data->id.')" value="' . route('admin.clientStatus.destroy', $data->id) . '">
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
        return view('admin.clientStatus.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!check_permission('Client Status Create')){
            abort(403);
        }
        return view('admin.clientStatus.create',);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!check_permission('Client Status Create')){
            abort(403);
        }
        $request->validate([
            'name' => 'required|min:1|max:200',
        ]);

        $clientStatus = new ClientStatus();
        $clientStatus->name = $request->name;
        $clientStatus->status = 1;

        try {
            $clientStatus->save();
            Toastr::success('Client Status added successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
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
        if(!check_permission('Client Status View')){
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
        if(!check_permission('Client Status Edit')){
            abort(403);
        }
        $clientStatus = ClientStatus::findOrFail($id);
        return view('admin.clientStatus.edit', compact('clientStatus'));
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
        if(!check_permission('Client Status Edit')){
            abort(403);
        }

        $clientStatus = ClientStatus::findOrFail($id);
        $request->validate([
            'name' => 'required|min:3|max:100',
        ]);

        $clientStatus->name = $request->name;
        $clientStatus->save();
        try {
            $clientStatus->save();
            Toastr::success('Client Status updated successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
            return redirect()->route('admin.clientStatus.index');
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
        if(!check_permission('Client Status Delete')){
            return response()->json([
                'type' => 'error',
                'message' => 'Whoops .You don\'t have this permission !',
            ]);
        }
        $clientStatus = ClientStatus::findOrFail($id);
        try {

            $clientStatus->delete();
            return response()->json([
                'type' => 'success',
                'message' => 'Client Status deleted successfully !',
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
        if(!check_permission('Client Status Edit')){
            return response()->json([
                'type' => 'error',
                'message' => 'Whoops .You don\'t have this permission !',
            ]);
        }
        $request->validate([
            'id' => 'required|exists:client_statuses,id',
        ]);
        $clientStatus = ClientStatus::find($request->input('id'));
        if ($clientStatus->status == 1) {
            $clientStatus->status = 0;
        } else {
            $clientStatus->status = 1;
        }
        try {
            $clientStatus->save();
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
