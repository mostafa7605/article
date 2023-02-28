<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\DeviceToken;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Article;
use App\Models\Tags;

class SearchController extends Controller
{

        public function search(Request $request)
        {
        $search=$request->search;

        $data = User::where(function ($q) use ($search){
             
        $q->where("name", "LIKE","%".$search."%");
        $q->orWhere("username", "LIKE","%".$search."%");})->select('id','username','image')->get();
        return response()->json([
        'message' => 'Search returned successfully ',
        'data'=>$data

        ], 200);

        }

        public function  search_article(Request $request)

        {
            $search=$request->search;

            if(!$request->has('paginate'))
            {

            $paginate=10;    
            }
            else
            {
            $paginate=$request->paginate;
            }
           
            $articles=Article::when(auth('api')->user(), function ($query)  {
            $query->with(['purchased' => function ($hasMany)  {


            return $hasMany->select(  \DB::raw('(CASE WHEN purchased_articles.user_id = ' .  auth('api')->user()->id . ' THEN true ELSE false END) AS purchased'));
            }]);  
            })->where(function ($q) use ($search){

            $q->where("title", "LIKE","%".$search."%");

            })->with('user')->with('category')->orderBy('created_at', 'DESC')->paginate($paginate);
            return response()->json([
                'message' => 'Article Returned Successfully',
                'data'=>$articles
                ], 200);  
        }

        public function search_tags(Request $request)
        {
        $search=$request->search;

        $data = Tags::where(function ($q) use ($search){
             
        $q->where("tag", "LIKE","%".$search."%");
        })->get();
      
        return response()->json([
        'message' => 'Search returned successfully ',
        'data'=>$data

        ], 200);

        }

}