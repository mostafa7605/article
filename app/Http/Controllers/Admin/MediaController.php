<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Category;
use App\Models\ImportData;
use App\Models\ImportDataFields;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Pagination\Paginator;

class MediaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:article-list|article-create|article-edit|article-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:article-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:article-edit', ['only' => ['edit', 'update', 'approved']]);
        $this->middleware('permission:article-delete', ['only' => ['destroy']]);
        $this->middleware('permission:article-hide', ['only' => ['show']]);
    }
    public function index()
    {
        $books = Article::where('category_id', (Category::where('name', 'LIKE', 'book')->first())->id)->get()->sortByDesc('created_at');
        $book_unapproved = Article::where('category_id', (Category::where('name', 'LIKE', 'book')->first())->id)->where('approved', 0)->get();

        $articles = Article::where('category_id', (Category::where('name', 'LIKE', 'article')->first())->id)->get()->sortByDesc('created_at');
        $articles_unapproved = Article::where('category_id', (Category::where('name', 'LIKE', 'article')->first())->id)->where('approved', 0)->get();

        $video_films = Article::where('category_id', (Category::where('name', 'LIKE', '%video%')->first())->id)->get()->sortByDesc('created_at');
        $video_films_unapproved = Article::where('category_id', (Category::where('name', 'LIKE', '%video%')->first())->id)->where('approved', 0)->get();

        $album_covers = Article::where('category_id', (Category::where('name', 'LIKE', '%album%')->first())->id)->get()->sortByDesc('created_at');
        $album_covers_unapproved = Article::where('category_id', (Category::where('name', 'LIKE', '%album%')->first())->id)->where('approved', 0)->get();

        $arts = Article::where('category_id', (Category::where('name', 'LIKE', 'art')->first())->id)->get()->sortByDesc('created_at');
        $arts_unapproved = Article::where('category_id', (Category::where('name', 'LIKE', 'art')->first())->id)->where('approved', 0)->get();
        return view('admin.media_new.index', compact('articles_unapproved', 'video_films_unapproved', 'album_covers_unapproved', 'arts_unapproved', 'books', 'articles', 'video_films', 'album_covers', 'arts', 'book_unapproved'));
    }
    public function unapproved_index()
    {


        $book_unapproved = Article::where('category_id', (Category::where('name', 'LIKE', 'book')->first())->id)->where('approved', 0)->get()->sortByDesc('created_at');
        $articles_unapproved = Article::where('category_id', (Category::where('name', 'LIKE', 'article')->first())->id)->where('approved', 0)->get()->sortByDesc('created_at');
        $video_films_unapproved = Article::where('category_id', (Category::where('name', 'LIKE', '%video%')->first())->id)->where('approved', 0)->get()->sortByDesc('created_at');

        $album_covers_unapproved = Article::where('category_id', (Category::where('name', 'LIKE', '%album%')->first())->id)->where('approved', 0)->get()->sortByDesc('created_at');

        $arts_unapproved = Article::where('category_id', (Category::where('name', 'LIKE', 'art')->first())->id)->where('approved', 0)->get()->sortByDesc('created_at');
        return view('admin.media_new.unapproved_index', compact('articles_unapproved', 'video_films_unapproved', 'album_covers_unapproved', 'arts_unapproved', 'book_unapproved'));
    }


    public function change_approve($id, $value)
    {
        Article::where('id', $id)->update(['approved' => $value]);
        $article = Article::where('id', $id)->first();

        $data = ['name' => $article->user->first_name];
        $email = $article->user->email;
        $url = 'https://newrwrite.msol.dev/article_view/' . $article->id;

        if ($value == 1) {
            foreach ($article->tagged_people as $tagged) {

                $sms_message = "You Have Been tagged\n" . $url;;
                send_sms($sms_message, $tagged->phone);


                $email = $tagged->email;
                $data = [
                    'article_name' => $article->title,
                    'id' => $article->id,
                    'name' => $tagged->first_name . " " . $tagged->last_name,
                ];
                Mail::send('emails.tagged_email', $data, function ($message) use ($email) {
                    $message->to($email)->subject('You Have Been tagged');
                    $message->from('info@rwrite.com', 'R-write');
                });
            }

            $invited_users = \DB::table('tagged_people')->where('article_id', $article->id)->whereNull('user_id')->groupBy('tagged_name')->get();

            foreach ($invited_users as $invited_user) {
                $find = ImportData::all();

                $filtered = $find->filter(function ($model) use ($invited_user) {
                    if ($model->instagram_name == $invited_user->tagged_name || $model->twitter_name == $invited_user->tagged_name || $model->twitter_name == $invited_user->facebook_name) {
                        $id =  $model->id;
                        return $id;
                    }
                })->first();
                if (!is_null($filtered)) {
                    $email = ImportDataFields::where('import_data_id', $filtered->id)->where('type', 'email')->first();
                    $phone = ImportDataFields::where('import_data_id', $filtered->id)->where('type', 'phone')->first();

                    if (!is_null($email)) {
                        $email_user = $email->value;
                        $data = ['article_id' => $article->id];
                        Mail::send('emails.invitation', function ($message) use ($email_user) {
                            $message->to($email_user)->subject('R-write Invitation');
                            $message->from('info@rwrite.com', 'R-write Invitation');
                        });
                    }
                    if (!is_null($phone)) {
                        $sms_message = "You have been invited to Rwrite platform. \n" . $url;
                        // SMS 
                        send_sms($sms_message, $phone->value);
                    }
                }
            }
        }



        return redirect('admin/media')->with('status', 'Article Updated successfully');
    }

    public function destroy($id)
    {
        Article::find($id)->delete();



        // session()->push('message', ['type' => 'success', 'message' => 'User deleted successfully']);
        echo "<script>alert('User Deleted');</script>";
        return redirect('admin/media');
    }

    public function search_media(Request $request)
    {

        $search = $request->search3;
        $filter = $request->filter_media;
        $Articles = [];
        if ($search) {

            if ($filter != null) {
                if ($filter == 0) {
                    $book_unapproved = Article::where(function ($q) use ($search) {
                        $q->where('title', 'LIKE', '%' . $search . '%')
                            ->where('category_id', (Category::where('name', 'LIKE', 'book')->first())->id)
                            ->where('approved', 0);
                    })->orwhere(function ($q) use ($search) {
                        $q->Where('description', 'LIKE', '%' . $search . '%')
                            ->where('category_id', (Category::where('name', 'LIKE', 'book')->first())->id)
                            ->where('approved', 0);
                    })->get()->sortByDesc('created_at');
                    $articles_unapproved = Article::where(function ($q) use ($search) {
                        $q->where('title', 'LIKE', '%' . $search . '%')
                            ->where('category_id', (Category::where('name', 'LIKE', 'article')->first())->id)
                            ->where('approved', 0);
                    })->orwhere(function ($q) use ($search) {
                        $q->Where('description', 'LIKE', '%' . $search . '%')
                            ->where('category_id', (Category::where('name', 'LIKE', 'article')->first())->id)
                            ->where('approved', 0);
                    })->get()->sortByDesc('created_at');
                    $video_films_unapproved = Article::where(function ($q) use ($search) {
                        $q->where('title', 'LIKE', '%' . $search . '%')
                            ->where('category_id', (Category::where('name', 'LIKE', '%video%')->first())->id)
                            ->where('approved', 0);
                    })->orwhere(function ($q) use ($search) {
                        $q->Where('description', 'LIKE', '%' . $search . '%')
                            ->where('category_id', (Category::where('name', 'LIKE', '%video%')->first())->id)
                            ->where('approved', 0);
                    })->get()->sortByDesc('created_at');
                    $album_covers_unapproved = Article::where(function ($q) use ($search) {
                        $q->where('title', 'LIKE', '%' . $search . '%')
                            ->where('category_id', (Category::where('name', 'LIKE', '%album%')->first())->id)
                            ->where('approved', 0);
                    })->orwhere(function ($q) use ($search) {
                        $q->Where('description', 'LIKE', '%' . $search . '%')
                            ->where('category_id', (Category::where('name', 'LIKE', '%album%')->first())->id)
                            ->where('approved', 0);
                    })->get()->sortByDesc('created_at');
                    $arts_unapproved = Article::where(function ($q) use ($search) {
                        $q->where('title', 'LIKE', '%' . $search . '%')
                            ->where('category_id', (Category::where('name', 'LIKE', 'art')->first())->id)
                            ->where('approved', 0);
                    })->orwhere(function ($q) use ($search) {
                        $q->Where('description', 'LIKE', '%' . $search . '%')
                            ->where('category_id', (Category::where('name', 'LIKE', 'art')->first())->id)
                            ->where('approved', 0);
                    })->get()->sortByDesc('created_at');
                    return view('admin.media_new.unapproved_index', compact('articles_unapproved', 'video_films_unapproved', 'album_covers_unapproved', 'arts_unapproved', 'book_unapproved'));
                } else {
                    $book_unapproved = [];
                    $articles_unapproved = [];
                    $video_films_unapproved = [];
                    $album_covers_unapproved = [];
                    $arts_unapproved = [];
                    $books = Article::where(function ($q) use ($search) {
                        $q->where('title', 'LIKE', '%' . $search . '%')
                            ->where('category_id', (Category::where('name', 'LIKE', 'book')->first())->id)
                            ->where('approved', 1);
                    })->orwhere(function ($q) use ($search) {
                        $q->Where('description', 'LIKE', '%' . $search . '%')
                            ->where('category_id', (Category::where('name', 'LIKE', 'book')->first())->id)
                            ->where('approved', 1);
                    })->get()->sortByDesc('created_at');
                    $articles = Article::where(function ($q) use ($search) {
                        $q->where('title', 'LIKE', '%' . $search . '%')
                            ->where('category_id', (Category::where('name', 'LIKE', 'article')->first())->id)
                            ->where('approved', 1);
                    })->orwhere(function ($q) use ($search) {
                        $q->Where('description', 'LIKE', '%' . $search . '%')
                            ->where('category_id', (Category::where('name', 'LIKE', 'article')->first())->id)
                            ->where('approved', 1);
                    })->get()->sortByDesc('created_at');
                    $video_films = Article::where(function ($q) use ($search) {
                        $q->where('title', 'LIKE', '%' . $search . '%')
                            ->where('category_id', (Category::where('name', 'LIKE', '%video%')->first())->id)
                            ->where('approved', 1);
                    })->orwhere(function ($q) use ($search) {
                        $q->Where('description', 'LIKE', '%' . $search . '%')
                            ->where('category_id', (Category::where('name', 'LIKE', '%video%')->first())->id)
                            ->where('approved', 1);
                    })->get()->sortByDesc('created_at');
                    $album_covers = Article::where(function ($q) use ($search) {
                        $q->where('title', 'LIKE', '%' . $search . '%')
                            ->where('category_id', (Category::where('name', 'LIKE', '%album%')->first())->id)
                            ->where('approved', 1);
                    })->orwhere(function ($q) use ($search) {
                        $q->Where('description', 'LIKE', '%' . $search . '%')
                            ->where('category_id', (Category::where('name', 'LIKE', '%album%')->first())->id)
                            ->where('approved', 1);
                    })->get()->sortByDesc('created_at');
                    $arts = Article::where(function ($q) use ($search) {
                        $q->where('title', 'LIKE', '%' . $search . '%')
                            ->where('category_id', (Category::where('name', 'LIKE', 'art')->first())->id)
                            ->where('approved', 1);
                    })->orwhere(function ($q) use ($search) {
                        $q->Where('description', 'LIKE', '%' . $search . '%')
                            ->where('category_id', (Category::where('name', 'LIKE', 'art')->first())->id)
                            ->where('approved', 1);
                    })->get()->sortByDesc('created_at');
                    return view('admin.media_new.index', compact('articles_unapproved', 'video_films_unapproved', 'album_covers_unapproved', 'arts_unapproved', 'books', 'articles', 'video_films', 'album_covers', 'arts', 'book_unapproved'));
                }
            } else {

                $books = Article::where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', '%' . $search . '%')
                        ->where('category_id', (Category::where('name', 'LIKE', 'book')->first())->id);
                })->orwhere(function ($q) use ($search) {
                    $q->Where('description', 'LIKE', '%' . $search . '%')
                        ->where('category_id', (Category::where('name', 'LIKE', 'book')->first())->id);
                })->get()->sortByDesc('created_at');
                $book_unapproved = Article::where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', '%' . $search . '%')
                        ->where('category_id', (Category::where('name', 'LIKE', 'book')->first())->id)
                        ->where('approved', 0);
                })->orwhere(function ($q) use ($search) {
                    $q->Where('description', 'LIKE', '%' . $search . '%')
                        ->where('category_id', (Category::where('name', 'LIKE', 'book')->first())->id)
                        ->where('approved', 0);
                })->get()->sortByDesc('created_at');


                $articles = Article::where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', '%' . $search . '%')
                        ->where('category_id', (Category::where('name', 'LIKE', 'article')->first())->id);
                })->orwhere(function ($q) use ($search) {
                    $q->Where('description', 'LIKE', '%' . $search . '%')
                        ->where('category_id', (Category::where('name', 'LIKE', 'article')->first())->id);
                })->get()->sortByDesc('created_at');
                $articles_unapproved = Article::where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', '%' . $search . '%')
                        ->where('category_id', (Category::where('name', 'LIKE', 'article')->first())->id)
                        ->where('approved', 0);
                })->orwhere(function ($q) use ($search) {
                    $q->Where('description', 'LIKE', '%' . $search . '%')
                        ->where('category_id', (Category::where('name', 'LIKE', 'article')->first())->id)
                        ->where('approved', 0);
                })->get()->sortByDesc('created_at');

                $video_films = Article::where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', '%' . $search . '%')
                        ->where('category_id', (Category::where('name', 'LIKE', '%video%')->first())->id);
                })->orwhere(function ($q) use ($search) {
                    $q->Where('description', 'LIKE', '%' . $search . '%')
                        ->where('category_id', (Category::where('name', 'LIKE', '%video%')->first())->id);
                })->get()->sortByDesc('created_at');
                $video_films_unapproved = Article::where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', '%' . $search . '%')
                        ->where('category_id', (Category::where('name', 'LIKE', '%video%')->first())->id)
                        ->where('approved', 0);
                })->orwhere(function ($q) use ($search) {
                    $q->Where('description', 'LIKE', '%' . $search . '%')
                        ->where('category_id', (Category::where('name', 'LIKE', '%video%')->first())->id)
                        ->where('approved', 0);
                })->get()->sortByDesc('created_at');

                $album_covers = Article::where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', '%' . $search . '%')
                        ->where('category_id', (Category::where('name', 'LIKE', '%album%')->first())->id);
                })->orwhere(function ($q) use ($search) {
                    $q->Where('description', 'LIKE', '%' . $search . '%')
                        ->where('category_id', (Category::where('name', 'LIKE', '%album%')->first())->id);
                })->get()->sortByDesc('created_at');
                $album_covers_unapproved = Article::where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', '%' . $search . '%')
                        ->where('category_id', (Category::where('name', 'LIKE', '%album%')->first())->id)
                        ->where('approved', 0);
                })->orwhere(function ($q) use ($search) {
                    $q->Where('description', 'LIKE', '%' . $search . '%')
                        ->where('category_id', (Category::where('name', 'LIKE', '%album%')->first())->id)
                        ->where('approved', 0);
                })->get()->sortByDesc('created_at');

                $arts = Article::where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', '%' . $search . '%')
                        ->where('category_id', (Category::where('name', 'LIKE', 'art')->first())->id);
                })->orwhere(function ($q) use ($search) {
                    $q->Where('description', 'LIKE', '%' . $search . '%')
                        ->where('category_id', (Category::where('name', 'LIKE', 'art')->first())->id);
                })->get()->sortByDesc('created_at');
                $arts_unapproved = Article::where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', '%' . $search . '%')
                        ->where('category_id', (Category::where('name', 'LIKE', 'art')->first())->id)
                        ->where('approved', 0);
                })->orwhere(function ($q) use ($search) {
                    $q->Where('description', 'LIKE', '%' . $search . '%')
                        ->where('category_id', (Category::where('name', 'LIKE', 'art')->first())->id)
                        ->where('approved', 0);
                })->get()->sortByDesc('created_at');


                return view('admin.media_new.index', compact('articles_unapproved', 'video_films_unapproved', 'album_covers_unapproved', 'arts_unapproved', 'books', 'articles', 'video_films', 'album_covers', 'arts', 'book_unapproved'));
            }
        } elseif ($filter != null) {
            if ($filter == 0) {
                $book_unapproved = Article::where('category_id', (Category::where('name', 'LIKE', 'book')->first())->id)->where('approved', 0)->get()->sortByDesc('created_at');
                $articles_unapproved = Article::where('category_id', (Category::where('name', 'LIKE', 'article')->first())->id)->where('approved', 0)->get()->sortByDesc('created_at');
                $video_films_unapproved = Article::where('category_id', (Category::where('name', 'LIKE', '%video%')->first())->id)->where('approved', 0)->get()->sortByDesc('created_at');

                $album_covers_unapproved = Article::where('category_id', (Category::where('name', 'LIKE', '%album%')->first())->id)->where('approved', 0)->get()->sortByDesc('created_at');

                $arts_unapproved = Article::where('category_id', (Category::where('name', 'LIKE', 'art')->first())->id)->where('approved', 0)->get()->sortByDesc('created_at');
                return view('admin.media_new.unapproved_index', compact('articles_unapproved', 'video_films_unapproved', 'album_covers_unapproved', 'arts_unapproved', 'book_unapproved'));
            } else {
                $book_unapproved = [];
                $articles_unapproved = [];
                $video_films_unapproved = [];
                $album_covers_unapproved = [];
                $arts_unapproved = [];
                $books = Article::where('category_id', (Category::where('name', 'LIKE', 'book')->first())->id)->where('approved', 1)->get()->sortByDesc('created_at');
                $articles = Article::where('category_id', (Category::where('name', 'LIKE', 'article')->first())->id)->where('approved', 1)->get()->sortByDesc('created_at');
                $video_films = Article::where('category_id', (Category::where('name', 'LIKE', '%video%')->first())->id)->where('approved', 1)->get()->sortByDesc('created_at');

                $album_covers = Article::where('category_id', (Category::where('name', 'LIKE', '%album%')->first())->id)->where('approved', 1)->get()->sortByDesc('created_at');

                $arts = Article::where('category_id', (Category::where('name', 'LIKE', 'art')->first())->id)->where('approved', 1)->get()->sortByDesc('created_at');
                return view('admin.media_new.index', compact('articles_unapproved', 'video_films_unapproved', 'album_covers_unapproved', 'arts_unapproved', 'books', 'articles', 'video_films', 'album_covers', 'arts', 'book_unapproved'));
            }
        } else {
            $book_unapproved = [];
            $articles_unapproved = [];
            $video_films_unapproved = [];
            $album_covers_unapproved = [];
            $arts_unapproved = [];
            return view('admin.media_new.unapproved_index', compact('articles_unapproved', 'video_films_unapproved', 'album_covers_unapproved', 'arts_unapproved', 'book_unapproved'));
        }
    }
}
