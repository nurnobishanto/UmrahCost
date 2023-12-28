<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceVoucher extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function voucherAccommodations()
    {
        return $this->hasMany(VoucherAccommodation::class);
    }
    public function voucherCompanies()
    {
        return $this->hasMany(VoucherCompany::class);
    }
    public function voucherFlightDetails()
    {
        return $this->hasMany(VoucherFlightDetails::class);
    }
    public function voucherGuests()
    {
        return $this->hasMany(VoucherGuest::class);
    }
    public function voucherTransportations()
    {
        return $this->hasMany(VoucherTransportation::class);
    }
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
