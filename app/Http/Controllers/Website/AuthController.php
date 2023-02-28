<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;
use App\Models\ImportData;
use App\Models\ImportDataFields;
use App\Events\NotificationDevice;
use App\helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        return view('website.auth.login');
    }

    public function user_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {

            return Redirect::back()->withInput()->withErrors($validator);
        }
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {

            User::where('id', Auth::user()->id)->update(['last_login' => date('Y-m-d')]);
            return redirect("/");
        } else {

            return redirect('login')->with('error', 'Please verify that your information is correct ');
        }
    }









    public function register()
    {
        return view('website.auth.register');
    }
    public function check_username(Request $request)
    {
        $user = User::where('username', $request->user_name)->first();
        if ($user) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    public function check_email2(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    public function register_user(Request $request)
    {


        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->user_name,
            'email' => $request->email,
            'google_id' => "test",
            'phone' => '+' . $request->countryCode . $request->phone,
            'password' => Hash::make($request->password)
        ]);
        $role = Role::where('name', 'Customer')->first();
        $user->assignRole([$role->id]);
        // $user = User::where('email', 'hadeel@msol.dev')->first();
        $phone = $request->countryCode . $request->phone;
        $email = $request->email;
        $find = ImportDataFields::all();
        $filtered = $find->filter(function ($model) use ($email, $phone) {
            if ($model->value == $email || $model->value == $phone) {
                $id =  $model->id;
                return $id;
            }
        })->first();
        if (!is_null($filtered)) {
            $user_ig = ImportData::where('id', $filtered->import_data_id)->first();
            User::where('id', $user->id)->update([
                'facebookname' => $user_ig->facebook_username,
                'instagramname' => $user_ig->ig_username,
                'twittername' => $user_ig->twitter_username
            ]);
        }


        event(new NotificationDevice($user, "Thank you " . $user->first_name . " for joining the R- Write Team. Let’s embark on this journey into rewriting history!", "Rwrite", "index"));

        $email = $request->email;
        $data = [
            'name' => $user->first_name . " " . $user->last_name,
        ];
        \Mail::send('emails.welcome', $data, function ($message) use ($email) {
            $message->to($email)->subject('WELCOME');
            $message->from('info@rwrite.com', 'WELCOME');
        });
        $sms_message = 'Thank you ' . $user->first_name . ' for joining the R- Write Team. Let’s embark on this journey into rewriting history!';
        send_sms($sms_message, '+' . $request->countryCode . $request->phone);

        Auth::login($user);
        User::where('id', $user->id)->update(['last_login' => date('Y-m-d')]);
        return redirect("/");
    }



    public function update_password(Request $request)
    {

        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }

























    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();
            // dd($user);
            $finduser = User::where('email', $user->email)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect()->route('home');
            } else {
                $newUser = User::updateOrCreate(
                    ['email' => $user->email],
                    [
                        'name' => $user->name,
                        'password' => Hash::make('123456dummy')
                    ]
                );

                Auth::login($newUser);

                return redirect()->route('home');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->to('/');
    }

    public function forget()
    {
        return view('website.auth.forget-password');
    }

    public function new_password()
    {
        return view('website.auth.new-password');
    }

    public function change_password()
    {
        return view('website.auth.change-password');
    }

    public function check_email()
    {
        return view('website.auth.check-email');
    }

    // public function password_reset()
    // {
    //     return view('website.auth.password-reset');
    // }

    public function password_reset_email($token)
    {
        return view('website.auth.password-reset-email', ['token' => $token]);
    }

    public function forget_password(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $role_customer = Role::where('name', 'Customer')->first();
        $user = User::where('email', $request->email)->whereHas('roles', function ($q) use ($role_customer) {
            $q->where('roles.id', $role_customer->id);
        })->first();

        if (!$user) {
            return back()->withInput()->with('error', 'The selected email is invalid!');
        }


        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('emails.new_forget_password', ['token' => $token, 'name' => $user->first_name . " " . $user->last_name], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Your new secret life changing Password');
            $message->from('info@rwrite.com', 'Your new secret life changing Password');
        });

        return back()->with('error', 'We have e-mailed your password reset link!');
    }

    public function update_password_email(Request $request)
    {

        //Validate input
        $validator = Validator::make($request->all(), [

            'password' => 'required|confirmed',
        ]);
        $token = $request->token;
        //check if payload is valid before moving on
        if ($validator->fails()) {

            return \Redirect::back()->withErrors($validator);
        }

        $password = $request->password;
        // Validate the token
        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();

        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData)  return redirect()->back()->withInput()->with('error', 'token is expired!');
        $customer = User::where('email', $tokenData->email)->first();
        // Redirect the user back if the email is invalid
        if (!$customer)
            return redirect()->back()->withInput()->with('error', 'Email not found');



        //Hash and update the new password
        $customer->password = \Hash::make($password);
        $customer->update(); //or $user->save();



        //Delete the token
        \DB::table('password_resets')->where('email', $customer->email)
            ->delete();
        return view('website.auth.password-reset');
    }
}
