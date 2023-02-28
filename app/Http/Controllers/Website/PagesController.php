<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;

class PagesController extends Controller
{
    public function about_us()
    {
        return view('website.pages.about_us.index');
    }

    public function person_profile($id)
    {
        $articales = Article::where('user_id', $id)->where('approved', 1)->get();

        $user = User::find($id);

        return view('website.pages.profile.person-profile', compact('articales', 'user'));
    }

    public function how_it_work()
    {
        return view('website.pages.how_work.index');
    }

    public function unsubscribe()
    {
        return view('website.pages.mail.index');
    }



    public function unsubscribe3()
    {
        return view('website.pages.mail.unsubscribe _me');
    }
}
