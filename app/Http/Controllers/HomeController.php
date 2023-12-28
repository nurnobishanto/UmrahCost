<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirectToDashboard()
    {
        if (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'crm') {
            return redirect(RouteServiceProvider::ADMIN_DASHBOARD);
        } else if (auth()->user()->user_type == 'client') {
            return redirect(RouteServiceProvider::CLIENT_DASHBOARD);
        } else {
            Auth::logout();
            return redirect()->route('login')->with('warning', 'Whoops ! This portal is not for you .');
        }
    }
}
