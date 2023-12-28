<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPackage extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function packageHotels()
    {
        return $this->hasMany(CustomPackageHotel::class);
    }
    public function packageGuides()
    {
        return $this->hasMany(CustomPackageGuide::class);
    }
    public function packageType()
    {
        return $this->belongsTo(PackageType::class);
    }
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }
    public function transport()
    {
        return $this->belongsTo(Transport::class);
    } 
    public function status()
    {
        return $this->belongsTo(Status::class,'status_id');
    }    
    public function mailSentBy()
    {
        return $this->belongsTo(User::class,'mail_sent_by');
    }
}
