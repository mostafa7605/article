<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\CategoryProducts;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Validator;
use DB;
use Illuminate\Support\Str;
use App\Notifications\ResetPasswordCustomer;
use App\Models\User;
class PasswordController extends Controller
{

    public function update_password(Request $request) 
    {

        $user=auth('api')->user();

        $validator = Validator::make($request->all(), [
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required','string','min:6'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        User::find(auth()->user('api')->id)->update(['password'=> bcrypt($request->new_password)]);
        return response()->json([
            'success' => true,
            'message' => 'Password Updated Successfully.',
          
            ], 201);
    }

            public function forgot_password(Request $request) 
            {
            $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',

            ]);
            if ($validator->fails()) {
            return response()->json($validator->errors(),401);
            }
            $user =User::where('email', '=', $request->email)
            ->first();
            //Check if the user exists
            if (is_null($user)) {
            return response()->json(['error' => 'User Doesnt Exist'], 500);
            }

            //Create Password Reset Token
            DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => Str::random(60),
            'created_at'=>date('Y-m-d H:i:s'),

            ]);
            //Get the token just created above
            $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->latest()->first();

            if ($this->sendResetEmail($request->email, $tokenData->token)) {
            return response()->json([
            'success' => true,
            'message' => 'A Forget email has been sent to your email address..',
            // time to expiration

            ], 201);
            } else {
            return response()->json(['error' => 'A Network Error occurred. Please try again.'], 401);

            }
            }

            private function sendResetEmail($email, $token)
            {
            //Retrieve the user from the database
            $customer =User::where('email', $email)->select('name', 'email')->first();
            //Generate, the password reset link. The token generated is embedded in the link
            
            try {
            $data=['customer'=>$customer,'token'=>$token];
            $customer->notify(new ResetPasswordCustomer($data));
            //Here send the link with CURL with an external email API 
            return true;
            } catch (\Exception $e) {
         
            return false;
            }
            }
}