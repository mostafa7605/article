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

class ProfileController extends Controller
{
        public function get(Request $request)
        {
           $user=auth('api')->user();

           if(!$request->has('paginate'))
           {

           $paginate=10;    
           }
           else
           {
           $paginate=$request->paginate;
           }
         
$bookmarks=Bookmark::where('user_id',$user->id)->select('article_id')->get()->pluck('article_id');
$bookmarked_articles=Article::whereIn('id',$bookmarks->toArray())
->with('category')->when(auth('api')->user(), function ($query)  {
$query->with(['purchased' => function ($hasMany)  {
return $hasMany->select(  \DB::raw('(CASE WHEN purchased_articles.user_id = ' .  auth('api')->user()->id . ' THEN true ELSE false END) AS purchased'));
}]);  
})->with('user')->where('show',1)->where('approved',1)->get();

$user_articles=Article::where('user_id',$user->id)->with('category')->when(auth('api')->user(), function ($query)  {
$query->with(['purchased' => function ($hasMany)  {
return $hasMany->select(  \DB::raw('(CASE WHEN purchased_articles.user_id = ' .  auth('api')->user()->id . ' THEN true ELSE false END) AS purchased'));
}]);  
})->with('user')->get();


$tagged_articles=$user->tagged_articles()->with('category')->with('user')->when(auth('api')->user(), function ($query)  {
$query->with(['purchased' => function ($hasMany)  {
return $hasMany->select(  \DB::raw('(CASE WHEN purchased_articles.user_id = ' .  auth('api')->user()->id . ' THEN true ELSE false END) AS purchased'));
}]);  
})->where('show',1)->where('approved',1)->get();
return response()->json([
'message' => 'Article Returned Successfully',
'data' =>
[
'bookmarked'=>$bookmarked_articles,
'user_articles'=>$user_articles,
'tagged_articles'=>$tagged_articles,
],
'success'=>true

], 200);
        }

        public function update(Request $request){
            $user=auth('api')->user();
           
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|between:2,100',
                'last_name' => 'required|string|between:2,100',
                'phone' =>'required|unique:users,phone,'.$user->id,
                'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
                'username' => 'required|string|max:255|alpha_dash|unique:users,username,'.$user->id
                
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
           $path=auth('api')->user()->image;
            if($request->hasFile('image')){
    
             
                $image = time().'.'.$request->image->extension();
         
                $request->image->move(public_path('users/image/'), $image); 
                $path=('users/image/').$image;
    
      
            }       
           User::where('id',$user->id)->update(['first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'gender'=>$request->gender,
            'image'=>$path,
            'username'=>$request->username,
          ]);
            $user=  User::where('id',$user->id)->first();
            return response()->json([
                'message' => 'User successfully updated',
                'data'=>$user
             
            ], 201);
        }
    }