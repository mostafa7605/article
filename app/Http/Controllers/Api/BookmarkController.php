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

class BookmarkController extends Controller
{
        public function add_bookmark($id)

        {
            $user=auth('api')->user();
            $article=Article::find($id);
            if(!$article)
            {
                return response()->json([
                    'message' => 'This Article Doesnt Exist',
                    'error'=>true

                    ], 500);
            }
            $bookmark=Bookmark::where('article_id',$id)->where('user_id', $user->id)->first();


            if( !is_null($bookmark))
            {
                return response()->json([
                    'message' => 'Article Already Existed',
                    'error'=>true

                    ], 500);
            }

            else
            {
                Bookmark::create(['user_id'=>$user->id,'article_id'=>$id]);
                return response()->json([
                    'message' => 'Article Bookmarked Successfully',
                    'success'=>true

                    ], 200);
            }

        }


        public function remove_bookmark($id)

        {

            $user=auth('api')->user();
            $article=Article::find($id);
            if(!$article)
            {
            return response()->json([
            'message' => 'This Article Doesnt Exist',
            'error'=>true

            ], 500);
            }

            Bookmark::where('article_id',$id)->where('user_id', $user->id)->delete();
            return response()->json([
            'message' => 'Article UnBookmarked Successfully',
            'success'=>true

            ], 200);

        }

        public function get(Request $request)

        {
            $user=auth('api')->user();
$bookmarks=Bookmark::where('user_id',$user->id)->select('article_id')->get()->pluck('article_id');

$articles=Article::whereIn('id',$bookmarks->toArray())->get();
            return response()->json([
                'message' => 'Articles returned successfully',
                'data' => $articles,
                'success'=>true

                ], 200);
        }

    }
