<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function view()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $taged_articles = $user->tagged_articles->unique('id');
        $bookmarks_articles = $user->bookmark_article;
        $articles = Article::where('user_id', $id)->get();
        // dd($bookmarks_articles->first()->article);
        return view('website.pages.profile.view', compact('taged_articles', 'bookmarks_articles', 'articles'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('website.pages.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {  //dd($request->all());
        $id = auth()->user()->id;
        $user = User::find($id);


        $path = auth()->user()->image;
        $cover_path = auth()->user()->cover;


        // dd($request->all());
        if ($request->File('image')) {

            $image = time() . '.' . $request->image->extension();

            $request->image->move(public_path('users/images/img/'), $image);
            $path = ('users/images/img/') . $image;
        }
        if ($request->hasFile('cover')) {


            $cover = time() . '.' . $request->cover->extension();

            $request->cover->move(public_path('users/images/cover/'), $cover);
            $cover_path = ('users/images/cover/') . $cover;
        }
        User::where('id', $user->id)->update([

            'bio' => $request->bio,

            'image' => $path,

            'cover' => $cover_path,
        ]);




        return redirect('/profile');
    }
    public function socialsync($social_name)
    {

        return Socialite::driver($social_name)->redirect();;
    }
    public function socialsyncCallback(Request $request, $social_name)
    {


        $user = Socialite::driver($social_name)->user();

        if ('facebook') {
            $username = $user->name;
        }

        $id = auth()->user()->id;
        $user = User::find($id);
        switch ($social_name) {
            case 'facebook':
                $user->update(['facebookname' => $username]);
                break;
            case 'twitter':
                $user->update(['twittername' => $username]);
                break;
            default:
                $user->update(['instagramname' => $username]);
                break;
        }

        return redirect()->to('/profile')->with('success', 'Sync is done');;
    }
}
