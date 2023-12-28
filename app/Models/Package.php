<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
    
    public function packageTypes()
    {
        return $this->hasMany(PackageType::class);
    }


}
