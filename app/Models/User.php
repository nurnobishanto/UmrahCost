<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */

    public function customStatus()
    {
        return $this->belongsTo(Status::class,'status_id');
    }
    public function clientStatus()
    {
        return $this->belongsTo(ClientStatus::class,'client_status_id');
    }
    public function clientSource()
    {
        return $this->belongsTo(ClientSource::class,'client_source_id');
    }
    public function crm()
    {
        return $this->belongsTo(User::class,'crm_id');
    }
    public function queryAbout()
    {
        return $this->belongsTo(QueryAbout::class,'query_about_id');
    }
    
    public function customPackages()
    {
        return $this->belongsTo(CustomPackage::class,'client_id');
    }
}
