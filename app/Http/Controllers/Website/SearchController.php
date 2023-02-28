<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use App\Models\User;
use App\Models\Users_Followers;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
  public function view(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'search' => 'required',
      'search_type' => 'required'
    ]);

    if ($validator->fails()) {
      return Redirect::back()->withInput()->withErrors($validator);
    }
    // dd($validator);
    $search = $request->search;
    if ($request->search_type == '2') {
      $role = Role::where('name', 'Customer')->first()->id;
      $users = DB::table('users')->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')->where(function ($q) use ($search, $role) {
        $q->where('model_has_roles.role_id', $role)->where('first_name', 'LIKE', '%' . $search . '%');
      })->orWhere(function ($q) use ($search, $role) {
        $q->where('model_has_roles.role_id', $role)
          ->where('last_name', 'LIKE', '%' . $search . '%');
      })->orWhere(function ($q) use ($search, $role) {
        $q->where('model_has_roles.role_id', $role)
          ->where('email', 'LIKE', '%' . $search . '%');
      })->orWhere(function ($q) use ($search, $role) {
        $q->where('model_has_roles.role_id', $role)
          ->where('username', 'LIKE', '%' . $search . '%');
      })->get();

      $view =  view('website.pages.search.partial.followers', compact('users'))->render();
    } else if ($request->search_type == '1') {
     
      $all_articales = Article::where(function ($q) use ($search) {
        $q->where('title', 'LIKE', '%' . $search . '%')
          ->where('approved', 1);
      })->orwhere(function ($q) use ($search) {
        $q->Where('description', 'LIKE', '%' . $search . '%')

          ->where('approved', 1);
      })->get();
      //dd($all_articales);
      $free_articales = Article::where(function ($q) use ($search) {
        $q->where('title', 'LIKE', '%' . $search . '%')
          ->where('purchase_type', 0)
          ->where('approved', 1);
      })->orwhere(function ($q) use ($search) {
        $q->Where('description', 'LIKE', '%' . $search . '%')
          ->where('purchase_type', 0)
          ->where('approved', 1);
      })->get();
      //dd($free_articales);
      $paid_articales = Article::where(function ($q) use ($search) {
        $q->where('title', 'LIKE', '%' . $search . '%')
          ->where('purchase_type', 1)
          ->where('approved', 1);
      })->orwhere(function ($q) use ($search) {
        $q->Where('description', 'LIKE', '%' . $search . '%')
          ->where('purchase_type', 1)
          ->where('approved', 1);
      })->get();
     // dd($paid_articales);
      $view =  view('website.pages.search.partial.articales', compact('all_articales', 'free_articales', 'paid_articales'))->render();
    
    }


    return view('website.pages.search.view', compact('view'));
  }
}
