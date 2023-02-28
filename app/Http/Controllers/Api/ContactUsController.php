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
use App\Models\Category;
use App\Models\Comment;
use App\Models\Bookmark;

class ContactUsController extends Controller
{
    public function contact_us(Request $request)
    {
     
      $data=[
        'email'=>$request->email,
        'name'=>$request->name,
        'messageData'=>$request->message,
        'phone'=>$request->phone,

      ];
   
    \Mail::send('emails.contact_us', $data, function ($message)  {
      $message->to('info@r-write.com')->subject('R-Write: Contact Us');
      $message->from('info@r-write.com', 'R-Write');
      });

      return response()->json(['success' => true, 'message' => 'Done']);

    }

}