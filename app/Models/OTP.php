<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;
    protected $fillable = ['phone', 'code', 'type', 'expires_at'];

    public static function generateOrUpdateOTP($phone, $type = 'register', $expiresInMinutes = 60)
    {
        $otp = self::where('phone', $phone)
            ->where('type', $type)
            ->first();

        if ($otp) {
            // Update existing OTP record
            $otp->code = rand(100000, 999999);
            $otp->expires_at = now()->addMinutes($expiresInMinutes);
            $otp->save();
        } else {
            // Create new OTP record
            $otp = self::create([
                'phone' => $phone,
                'code' => rand(100000, 999999),
                'type' => $type,
                'expires_at' => now()->addMinutes($expiresInMinutes),
            ]);
        }

        $msg = 'আপনার জমজম ট্রাভেলস ওটিপি হল : ' . $otp->code;
        bulksmsbd_sms_send($phone, $msg);
        return $otp;
    }
    public static function checkOTP($phone, $code, $type = 'register')
    {
        $otp = self::where('phone', $phone)
            ->where('code', $code)
            ->where('type', $type)
            ->where('expires_at', '>=', now())
            ->first();

        return $otp ? true : false;
    }
}
