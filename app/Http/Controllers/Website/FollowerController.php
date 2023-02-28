<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Users_Followers;

class FollowerController extends Controller
{
    public function index_follower(){
    	$auth_user=auth()->user();
    	
    	$followers=$auth_user->relationships_followers;
    	//dd($followers);
        return view('website.pages.follower.index_follower',compact('followers'));
    }

    public function index_following(){
    	$auth_user=auth()->user();
    	$following=$auth_user->relationships_following;
    	
    	//dd($followers);
        return view('website.pages.follower.index_following',compact('following'));
    }


    public function change_following($id){
    	$user=User::find($id);
      if(Users_Followers::where('user_id',auth()->user()->id)->where('follow_id',$id)->first()){
      	Users_Followers::where('user_id',auth()->user()->id)->where('follow_id',$id)->delete();
      	$message='Follow';
      }else{
      	Users_Followers::create(['user_id'=>auth()->user()->id,'follow_id'=>$id]);
      	$message='Unfollow';
      }
      $count_followers=count($user->relationships_followers);
       return response()->json(['message' => $message,'count'=>$count_followers ?? []]);
    }
}
