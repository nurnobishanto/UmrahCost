<?php

namespace App\Http\Controllers;

use App\Models\CustomPackage;
use App\Models\ServiceVoucher;
use App\Models\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function customPackage($id){
        $customPackage = CustomPackage::findOrFail(decrypt($id));
        $onload = false;

        return view('others.invoice.customPackage', compact('customPackage','onload'));
    }
    
    public function customerInvoice($id){
        $customPackage = CustomPackage::findOrFail(decrypt($id));
        $onload = false;
        return view('others.invoice.customerInvoice', compact('customPackage','onload'));

    }
    
    public function clientPreview($id){
        $client = User::findOrFail(decrypt($id));
        $onload = false;
    
        return view('others.invoice.clientPreview', compact('client','onload'));

    }

    public function serviceVoucher($id){
        $serviceVoucher = ServiceVoucher::with([
            'voucherAccommodations',
            'voucherCompanies',
            'voucherFlightDetails',
            'voucherGuests',
            'voucherTransportations'
        ])->findOrFail(decrypt($id));
        $onload = false;

        return view('others.invoice.serviceVoucher', compact('onload', 'serviceVoucher'));
    }
}
