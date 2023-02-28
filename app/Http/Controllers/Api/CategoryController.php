<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\DeviceToken;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use Socialite;
use App\Models\Category;

class CategoryController extends Controller
{

    public function get()
    {
        $categories=Category::all();
        return response()->json([
            'message' => 'Category Returned successfully',
            'data'=>  $categories 
        ], 200);
    }


    public function post(Request $request)
    {

        if($request->hasFile('image')){

         
            $image = time().'.'.$request->image->extension();
     
            $request->image->move(public_path('categories/image/'), $image); 
            $path=('categories/image/').$image;

  
        }
        $category=Category::create(['name'=>$request->name,'image'=>$path]);
        $categories=Category::all();
        return response()->json([
            'message' => 'Category Returned successfully',
            'data'=>  $categories 
        ], 200);
    }

    public function get_additional_fields($id)
    {
        $category=Category::find($id);

        return response()->json([
            'message' => 'Category Returned successfully',
            'data'=>  $category->category_additional_fields 
        ], 200);

    }

}