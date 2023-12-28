<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PackageInfo;

class HotelInfo extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function package_infos()
    {
        return $this->hasOne(PackageInfo::class);
    }
}
