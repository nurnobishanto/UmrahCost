<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPackageHotel extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
    public function sightseeing()
    {
        return $this->belongsTo(Sightseeing::class);
    }
    public function customPackage()
    {
        return $this->belongsTo(CustomPackage::class);
    }
}
