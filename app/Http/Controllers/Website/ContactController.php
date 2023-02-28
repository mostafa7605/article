<?php

namespace App\Http\Controllers\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Message;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
class ContactController extends Controller

{
    
    public function save_message(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',

            'phone'=>'required|numeric',
            'email' => 'required|email',
            'message'=> 'required'
        ]);
        if($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }


        Message::create(['name'=>$request->name,'phone'=>$request->countryCode.$request->phone,'email'=>$request->email,'message'=>$request->message,'seen'=>0]);
        return redirect('/')
                        ->with('status','Message sent successfully');

    }
}