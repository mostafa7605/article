<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdditionalField;
use App\Models\Article;
use App\Models\DeviceToken;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use Socialite;


class DeviceTokenController extends Controller
{
        public function device_token(Request $request)

        {

            $user=auth('api')->user();
            $device_token=DeviceToken::where('user_id',$user->id)->where('device_token',$request->device_token)->first();
            if(is_null( $device_token))
            {


                DeviceToken::create(['user_id'=>$user->id,'device_token'=>$request->device_token]);
            }

            return response()->json([
                'message' => 'Device Token successfully updated',
             
            ], 201);

        }

}