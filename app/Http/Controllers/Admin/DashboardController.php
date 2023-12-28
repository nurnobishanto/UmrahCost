<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPackage;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $allClients = User::where('user_type', 'client')->count();
        $crms = User::where('user_type', 'crm')->count();
        $packageCreated = CustomPackage::all()->count();
        $clientsByStatus = User::where('user_type', 'client')
                            ->with('clientStatus')
                            ->select('client_status_id', DB::raw('count(*) as total'))
                            ->groupBy('client_status_id')
                            ->get();

        return view('admin.dashboard.index',compact('allClients','clientsByStatus','crms','packageCreated') );
    }
}
