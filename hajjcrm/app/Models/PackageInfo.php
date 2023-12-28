<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HotelInfo;

class PackageInfo extends Model
{
    use HasFactory;

    public function hotel_infos()
    {
        return $this->belongsTo(HotelInfo::class, 'package_info_id');
    }
}
