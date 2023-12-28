<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPackageGuide extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }
    
    public function customPackage()
    {
        return $this->belongsTo(CustomPackage::class);
    }
}
