<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }
    public function sightseeings()
    {
        return $this->hasMany(Sightseeing::class);
    }
}
