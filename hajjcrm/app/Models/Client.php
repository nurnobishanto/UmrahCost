<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function source(){
        return $this->belongsTo(Source::class, 'source_id', 'id');
    }


    public function crm(){
        return $this->belongsTo(CRM::class, 'crm_id', 'id');
    }

    public function packages(){
        return $this->hasMany(Package::class,  'client_id', 'id')->orderBy('packages.id', 'desc');
    }

}
