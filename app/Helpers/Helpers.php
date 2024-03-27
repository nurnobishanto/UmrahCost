<?php

use App\Models\ClientStatus;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleHasPermission;
use App\Models\StaticOption;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

if (!function_exists('random_code')) {
    function set_static_option($key, $value)
    {
        if (!StaticOption::where('option_name', $key)->first()) {
            StaticOption::create([
                'option_name' => $key,
                'option_value' => $value
            ]);
            return true;
        }
        return false;
    }

    function get_static_option($key)
    {
        if (StaticOption::where('option_name', $key)->first()) {
            $return_val = StaticOption::where('option_name', $key)->first();
            return $return_val->option_value;
        }
        return null;
    }

    function update_static_option($key, $value)
    {
        if (!StaticOption::where('option_name', $key)->first()) {
            StaticOption::create([
                'option_name' => $key,
                'option_value' => $value
            ]);
            return true;
        } else {
            StaticOption::where('option_name', $key)->update([
                'option_name' => $key,
                'option_value' => $value
            ]);
            return true;
        }
        return false;
    }

    function common_date_time_format($date_time)
    {
        if ($date_time)
            return Carbon::parse($date_time)->format('Y-m-d h:i:s A');
        return '';
    }

    function common_date_format($date_time)
    {
        if ($date_time)
            return Carbon::parse($date_time)->format('d/m/Y');
        return '';
    }

    function common_full_month_date_format($date_time)
    {
        if ($date_time)
            return Carbon::parse($date_time)->format('jS F Y');
        return '';
    }

    function common_time_format($time)
    {
        if ($time)
            return Carbon::parse($time)->format('h:i:s A');
        return '';
    }

    function this_month_date_range()
    {
        $form   = Carbon::now()->startOfMonth()->format('Y-m-d');
        $to     = Carbon::now()->endOfMonth()->format('Y-m-d');
        $dateRange = [$form, $to];
        return $dateRange;
    }

    function this_year_date_range()
    {
        $form   = Carbon::now()->startOfYear()->format('Y-m-d');
        $to     = Carbon::now()->endOfYear()->format('Y-m-d');
        $dateRange = [$form, $to];
        return $dateRange;
    }

    function html_input_date($date_time)
    {
        if ($date_time)
            return Carbon::parse($date_time)->format('Y-m-d');
        return '';
    }

    function html_input_time($date_time)
    {
        if ($date_time)
            return Carbon::parse($date_time)->format('H:i');
        return '';
    }

    function days_array()
    {
        $array = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        return $array;
    }

    function time_difference_in_minutes($timeOne, $timeTwo)
    {
        $date1 = new DateTime('2020-09-01 ' . $timeOne);
        $date2 = new DateTime('2020-09-01 ' . $timeTwo);
        $diff_mins = abs($date1->getTimestamp() - $date2->getTimestamp()) / 60;

        return $diff_mins;
    }

    function time_difference_in_days($timeOne, $timeTwo)
    {
        $d1 = strtotime($timeOne);
        $d2 = strtotime($timeTwo);
        $totalDiffDays = abs($d1 - $d2) / 60 / 60 / 24;

        return $totalDiffDays + 1;
    }

    function send_push_notification($title, $body, $registration_ids)
    {
        $notification = [
            //write title, body and so on
            'title'         => $title,
            'body'   => $body,
        ];
        $extraNotificationData = ["message" => $notification, "moredata" => ''];
        $fcmNotification = [
            // 'registration_ids' => [],
            'registration_ids' => $registration_ids, //multple token array
            // 'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];
        $headers = [
            'Authorization: key=' . env('PUSH_NOTIFICATION_API_ACCESS_KEY'),
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('PUSH_NOTIFICATION_API_URL'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function time_difference_in_seconds($timeOne, $timeTwo)
    {
        $d1 = strtotime($timeOne);
        $d2 = strtotime($timeTwo);
        $totalDiffDays = abs($d1 - $d2);

        return $totalDiffDays + 1;
    }

    function is_https()
    {
        if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
            return TRUE;
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https') {
            return TRUE;
        } elseif (!empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
            return TRUE;
        }

        return FALSE;
    }

    function client_statuses(){
        $clientStatuses = ClientStatus::where('status',1)->get();
        return $clientStatuses;
    }

    function one_to_ten_array(){
        return range(1, 10);
    }

    function number_range_to_array($one, $two){
        return range($one, $two);
    }

    function send_sms($number, $message){
        // $url = env('SMS_API_URL');
        // $data = [
        //   "api_key" =>env('SMS_API_KEY'),
        //   "type" => "text",
        //   "contacts" => $number,
        //   "senderid" => env('SMS_SENDER_ID'),
        //   "msg" => $message,
        // ];
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // $response = curl_exec($ch);
        // curl_close($ch);
        // return $response;

        $number = preg_replace('#[ -]+#', '', $number);
        $number = preg_replace('#[=]+#', '', $number);
        if(strlen($number)==10 || strlen($number)==13){
            $number = "0".$number;
        }

        $message = str_replace("<br>","\n",$message);
        $message = str_replace(" ","+",$message);
        $message = strip_tags($message);

        // new sms
        $apiKey = env('SMS_API_KEY');
        $apiToken = env('SMS_API_TOKEN');
        $senderID = env('SMS_SENDER_ID');
        $to = $number;
        $text = $message;
        $scheduleDate = '';
        $route = '0';

        $url = "http://mimsms.com.bd/smsAPI?sendsms&apikey=$apiKey&apitoken=$apiToken&type=sms&from=$senderID&to=$to&text=$text&scheduledate=$scheduleDate&route=$route";
        $response = file_get_contents($url);
        return $response;


    }

    function currency_convertion($amount, $conversion_rate){
        $inAmount = $amount*$conversion_rate;
        return common_number_format($inAmount);
    }

    function common_number_format($number)
    {
        if ($number){
            return number_format($number, 2);
        }
        return '0.00';
    }

    function check_role_has_permission($role_slug,$permission_name){

        $role = Role::where('slug', $role_slug)->first();
        $permission = Permission::where('name', $permission_name)->first();

        if($role && $permission){
            $roleHasPermission = RoleHasPermission::where([['role_id',$role->id],['permission_id',$permission->id]])->first();
            if($roleHasPermission){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    function check_permission($permissionName){
        if(check_role_has_permission(auth()->user()->user_type, $permissionName)){
            return true;
        }else{
            return false;
        }
    }

    function number_validation($number) {

        $number = str_replace(' ', '', $number);
        $number = str_replace('-', '', $number);

        if (preg_match('/^(\+880|880|0)?1(1|3|4|5|6|7|8|9)\d{8}$/', $number) == 1) {

            if (preg_match("/^\+88/", $number) == 1) {
                $number = str_replace('+', '', $number);
            }
            if (preg_match("/^880|^0/", $number) == 0) {
                $number = "880" . $number;
            }
            if (preg_match("/^88/", $number) == 0) {
                $number = "88" . $number;
            }

            return $number;
        } else {
            return false;
        }
    }

    function bulksmsbd_sms_send($phone_number,$msg) {

        $url = "http://bulksmsbd.net/api/smsapi";
        $api_key = get_static_option('bulksmsbd_api');
        $senderid = get_static_option('bulksmsbd_sender_id');
        $number = number_validation($phone_number);
        $message = trim($msg);

        $data = [
            "api_key" => $api_key,
            "senderid" => $senderid,
            "number" => $number,
            "message" => $message
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);


        $data = json_decode($response);
        if($data->response_code == 202){
            Toastr::success($data->success_message, 'Success', ["positionClass" => "toast-top-right", "timeOut" => "2500"]);
        }else{
            Toastr::error($data->error_message, 'Error', ["positionClass" => "toast-top-center", "timeOut" => "2500"]);

        }
    }
    function get_balance_bulksmsbd() {
        if(get_static_option('bulksmsbd_api')){
            $url = "http://bulksmsbd.net/api/getBalanceApi";
            $api_key = get_static_option('bulksmsbd_api');
            $data = [
                "api_key" => $api_key
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
            $data = json_decode($response);
            if($data->response_code == 202){
                return $data->balance;
            }else{
                return $data->error_message;
            }
        }
        else{
            return 'Enter api key to know balance';
        }

    }

}
