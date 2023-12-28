<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;


    public function client(){
        return $this->belongsTo(Client::class,'client_id', 'id');
    }

    public function packageInfo(){
        return $this->belongsTo(PackageInfo::class,'packageinfo_id', 'id');
    }

    public function flightInfo(){
        return $this->belongsTo(FlightInfo::class,'flight_id', 'id');
    }
}
