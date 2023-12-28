<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendInvoiceToUser;
use App\Models\CustomPackage;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Brian2694\Toastr\Facades\Toastr;

class CustomPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!check_permission('Custom Package List')){
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

        $customPackages = CustomPackage::with(['client','packageHotels', 'packageHotels.hotel', 'packageType', 'packageType.package'])->where('client_id', '!=',null)
                                            ->when($request->filled('datetimes'), function ($query) use ($from, $to) {
                                                $query->whereBetween('created_at', [$from, $to]);
                                            })
                                            ->when($request->filled('client_id'), function ($query) use ($request) {
                                                $query->where('client_id', $request->client_id);
                                            })
                                            ->orderBy('id','DESC')->paginate($show);
        $clients = User::where('user_type', 'client')->select('id','name')->get();
        $statuses = Status::where('status', 1)->get();

        return view('admin.customPackage.index', compact('customPackages','clients','statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function sendInvoiceToUser($id){
        
        $id = decrypt($id);
       
        $customPackage = CustomPackage::findOrFail($id);
        $email= $customPackage->client->email;
       

        $url = route('invoice.customerInvoice', encrypt($id));
        // $url = route('invoice.customerInvoice', $id);
      
        $subject = 'Custom package created from '. env('APP_NAME', 'Zamzam Travels');
        
        if($customPackage->client->email){
          $status = Mail::to($customPackage->client->email)->send(new SendInvoiceToUser($url, $subject, $customPackage->client));
        //   mail("receiving-email","subject","message-body","headers"); 
          
            // dd($status);
            // $customPackage->mail_sent = true;
            // $customPackage->mail_sent_by = auth()->user()->id;
            // $customPackage->save();

            // Toastr::success('Invoice sent to customer mail  !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
            
            // return redirect()->route('admin.customPackage.index');
            if ($status) {
                $customPackage->mail_sent = true;
                $customPackage->mail_sent_by = auth()->user()->id;
                $customPackage->save();
                Toastr::success('Invoice sent to customer mail!', 'Success', ["positionClass" => "toast-top-right", "timeOut" => "2500"]);
                return redirect()->route('admin.customPackage.index');
            } else {
                Toastr::error('Failed to send invoice!', 'Error', ["positionClass" => "toast-top-center", "timeOut" => "2500"]);
            }
            
        }else{
            Toastr::error('Whoops .This customer has no email !', 'Error', ["positionClass" => "toast-top-center","timeOut" => "2500"]);
            return redirect()->route('admin.customPackage.index');
        }
    }
    

    public function changeStatus($id, $status_id){
        try {
            $customPackage = CustomPackage::findOrFail($id);
            $customPackage->status_id = $status_id;
            $customPackage->save();
    
            $user = User::find($customPackage->client_id);
            $user->status_id = $status_id;
            $user->save();

            Toastr::success('Status Changed !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
        } catch (\Exception $exception) {
            Toastr::error('Whoops .Something went wrong!' . $exception->getMessage(), 'Error', ["positionClass" => "toast-top-center","timeOut" => "2500"]);
        }

        return back();
    }
}
