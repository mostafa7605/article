<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Auth;
use DB;
use App\Models\ImageSlider;
use App\Models\AppointmentDoctor;
use App\Models\Article;
use App\Models\Category;
use App\Models\AdditionalField;
use App\Models\Bookmark;
use App\Models\SmsCodes;
use Twilio\Rest\Client;
use App\Models\User;

class RegisterController extends Controller
{
    public function send_code(Request $request)
    {
        //dd($request->phoneNumber);
        $account_sid = "AC1b3f2c1f71b3eff9d02faaf0cf402294";
        $auth_token = "97e00a55faf0c458d00eca6d4797260e";
        $twilio = new Client($account_sid, $auth_token);
        $user = User::where('phone', $request->phoneNumber)->first();
        // dd($user);

        if (!is_null($user)) {
            return response()->json(['status' => false, 'message' => 'This number is already registered']);
        }

        try {
            $phone_number = $twilio->lookups->v1->phoneNumbers($request->phoneNumber)->fetch();
            $check = SmsCodes::where('phone', $request->phoneNumber)->first();
            $code = random_int(100000, 999999);

            if (is_null($check)) {
                SmsCodes::create(['phone' => $request->phoneNumber, 'sms_code' => $code]);
            } else {
                SmsCodes::where('phone', $request->phoneNumber)->update(['sms_code' => $code]);
            }

            $sms_message = $code . ' is your R-write verification code';
            send_sms($sms_message, $request->phoneNumber);

            return response()->json(['status' => true, 'message' => '']);
        } catch (\Exception $e) {

            return response()->json(['status' => false, 'message' => 'please check your country code']);
        }
    }

    public function check_phone_sms_code(Request $request)
    {

        $check = SmsCodes::where('phone', $request->phoneNumber)->where('sms_code', $request->code)->first();

        if (is_null($check)) {

            return response()->json(['status' => false, 'message' => 'Code isn`t correct']);
        } else {

            return response()->json(['status' => true, 'message' => '']);
        }
    }
}
