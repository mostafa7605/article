<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\ImageSlider;
use App\Models\AppointmentDoctor;
use App\Models\Article;
use App\Models\Category;
use App\Models\AdditionalField;
use App\Models\Bookmark;
use App\Models\ArticleTag;
use App\Models\Tag;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\AdditionalFieldValue;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Twilio\Rest\Client;
use App\helper;
use App\Models\Comment;
use App\Models\Tagged_people;
use Session;
use Stripe;
use App\Events\NotificationDevice;
use App\Models\Notification;

class ArticleController extends Controller
{

    public function create()
    {
        $categories = Category::all();
        $users = User::whereNotNull('username')->where('email', '!=', 'admin@gmail.com')->where('id', '!=', \Auth::user()->id)->select('id', 'username as username', 'image as avatar', 'email')->get();
        $tags = User::whereNotNull('twittername')->pluck('twittername');
        $tagsInstagram = User::whereNotNull('instagramname')->pluck('instagramname');
        return view('website.pages.article.create', compact('users', 'tags', 'tagsInstagram', 'categories'));
    }
    public function get_additional_category($id)
    {
        $categort = Category::where('id', $id)->first();
        $aditional = $categort->category_additional_fields;

        return response()->json([
            'aditional' => $aditional
                ?? []
        ]);
    }
    public function view($id)
    {

        $article = Article::Where('id', $id)->first();


        // dd($article);   
        if ($article) {

            if ($article->approved == 1) {
                if (Auth::check()) {
                    if ($article->user_id != Auth::user()->id) {
                        views($article)->record();
                    }
                } else {
                    views($article)->record();
                }
                if ($article->purchase_type == 0) {
                    $paid = 1;
                } else {

                    if (Auth::check()) {
                        if ($article->user_id == Auth::user()->id) {

                            $paid = 1;
                        } else {

                            $purchased = $article->purchased->pluck('id')->ToArray();
                            $user = Auth::user();
                            if (in_array($user->id, $purchased)) {

                                $paid = 1;
                            } else {
                                $paid = 0;
                            }
                        }
                    } else {
                        $paid = 0;
                    }
                }
            } else {

                if (Auth::check()) {
                    if ($article->user_id == Auth::user()->id) {
                        $paid = 1;
                    } else {
                        return redirect("/");
                    }
                } else {
                    return redirect("/");
                }
            }

            if (strtolower($article->category->name) == 'article' || (strtolower($article->category->name) == 'book')) {
                $this->update_comment_colors($article);
            }

            return view('website.pages.article.view', compact('article', 'paid'));
        } else {

            return redirect("/");
        }
    }
    public function article_read($id)
    {
        Notification::where('id',$id)->update(['read'=>1]);
        $article_id=Notification::where('id',$id)->first()->article->id;
        
        return redirect('/article/view/' . $article_id);
    }
    public function update_comment_colors($article)
    {

        $content = \File::get(public_path($article->content));

        $text =  $content;
        $doc = new \DOMDocument();
        @$doc->loadHTML($text);

        for ($i = 0; $i < count($doc->getElementsByTagName('div')); $i++) {

            $div = $doc->getElementsByTagName('div')[$i];
            $value = $div->nodeValue;
            $index = $div->getAttribute('data-index');
            $tagged_name = str_replace("@", "", $value);
            $tagged_name = str_replace("#", "", $tagged_name);
            $tagged_name = str_replace("|", "", $tagged_name);
            $tagged_name = ltrim($tagged_name);
            $tagged = Comment::where('article_id', $article->id)->where('tagged_name', $tagged_name)->where('index', $index)->first();

            $registered_names = User::where('username', $tagged_name)->first();

            if ($div->getAttribute('class') == 'add_comment') {

                if (!is_null($tagged)) {

                    foreach ($div->childNodes as $img) {
                        if ($img->nodeName == 'img') {
                            $img->setAttribute('src', '/images/Red.svg');
                        }
                    }
                    $doc->getElementsByTagName('div')[$i - 1]->setAttribute('class', 'comment_red_main');
                    $div->setAttribute('class', 'comment_red');
                }
            } else if ($div->getAttribute('class') == 'send_invitation') {

                if (!is_null($registered_names)) {


                    foreach ($div->childNodes as $img) {
                        if ($img->nodeName == 'img') {
                            $img->setAttribute('src', '/images/blue.png');
                        }
                    }


                    $doc->getElementsByTagName('div')[$i - 1]->setAttribute('class', 'add_comment_main');
                    $div->setAttribute('class', 'add_comment');
                }
            }
        }
        $text = trim($doc->saveHTML());


        // dd( $text);

        \File::delete($article->id . '.html');

        $file =  $article->id . '.html';
        $data = $text;
        file_put_contents($file, $data);
        $content = $file;

        \Storage::disk('public')->put('documents', $content);

        //  dd($text);

    }


    public function bookmark($id)
    {
        $booked = Bookmark::where(['user_id' => auth()->user()->id, 'article_id' => $id])->first();
        if (isset($booked)) { //booked
            $booked->delete();
        } else {
            Bookmark::create(['user_id' => auth()->user()->id, 'article_id' => $id]);
        }
        return response()->json(['message' => 'success']);
    }


    public function str_replace_n_new($search, $replace, $subject, $occurrence)
    {

        $s = $subject;
        $counter = 1;

        $search = "~\B@$search\b~";


        $s = preg_replace_callback($search, function ($m) use (&$counter, $occurrence, $replace, $search) {


            #-- replacement for 2nd occurence of "abc"
            if ($counter++ == $occurrence) {

                return $replace;
            }

            #-- else leave current match
            return $m[0];
        }, $s);

        return $s;
    }

    public function save_article(Request $request)
    {

        $user = Auth::user();
        $category = Category::find($request->category);
        if ($request->hasFile('file_upload2')) {
            $image = time() . '.' . $request->file_upload2->extension();
            $request->file_upload2->move(public_path('images' . '/' . $user->id . '/' .  str_replace(' ', '_', strtolower($category->name)) . '/image/'), $image);
            $path = ('images' . '/' . $user->id . '/' . str_replace(' ', '_', strtolower($category->name)) . '/image/') . $image;
        }
        if ($request->has('cktext') || $request->has('file_upload1')) {
            if (strtolower($category->name) != 'book' && strtolower($category->name) != 'article') {
                $content = time() . '.' . $request->file_upload1->extension();

                $request->file_upload1->move(public_path('images' . '/' . $user->id . '/' . str_replace(' ', '_', strtolower($category->name)) . '/content/'), $content);
                $content_path = ('images' . '/' . $user->id . '/' . str_replace(' ', '_', strtolower($category->name)) . '/content/') . $content;
            } elseif (strtolower($category->name) == 'article' || strtolower($category->name) == 'book') {
                $content_path = 'tests';
            }
        }
        if (isset($request->money)) {
            $cost = $request->money;
        } else {
            $cost = 0;
        }
        $purchase_type = 0;
        if ($request->flexRadioDefault == "Free") {
            $purchase_type = 0;
            $cost = 0;
        } else {
            $purchase_type = 1;
        }
        $article = Article::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'description' => $request->description,
            'purchase_type' => $purchase_type,
            'category_id' => $request->category,
            'content' => $content_path,
            /* 'file_name' => $request->fileNameArticleMedia,
            'file_type' => $request->fileTypeArticleMedia,
            'file_size' => $request->fileSizeArticleMedia,*/
            'cost' => $cost,
            'image' => $path
        ]);
        Article::where('id', $article->id)->update(['url' => 'api/article/' . $article->id]);
        if ($request->has('tags')) {
            // $tags = explode(',', $request->get('article_tag'));
            foreach ($request->tags as $tag_article) {

                if (!is_null($tag_article)) {
                    $tag = \DB::table('tags')->where('tag', $tag_article)->first();
                    if (is_null($tag)) {
                        $tag = \DB::table('tags')->insertGetId(['tag' => $tag_article]);

                        \DB::table('tags_article')->insert(['article_id' => $article->id, 'tag_id' => $tag]);
                    } else {
                        \DB::table('tags_article')->insert(['article_id' => $article->id, 'tag_id' => $tag->id]);
                    }
                }
            }
        }

        if (isset($request->aditional_fields_values)) {
            $i = 0;
            $aditionalFields = $category->category_additional_fields;
            foreach ($aditionalFields as $aditionalField) {
                if ($request->aditional_fields_values[$i] != null) {

                    AdditionalFieldValue::create(['article_id' => $article->id, 'additional_field_id' => $aditionalField->id, 'value' => $request->aditional_fields_values[$i]]);
                }
                $i++;
            }
        }



        if (strtolower($category->name) == 'article' || strtolower($category->name) == 'book') {

            preg_match_all('/\B@\w+(?:\.?\w+)*/', $request->cktext, $matches);


            $text = $request->cktext;

            $original_content = $request->cktext;
            $x = 1;

            foreach (array_count_values($matches[0]) as $value => $key) {


                $username = str_replace("@", "", $value);
                $username = str_replace("#", "", $username);
                $find = User::where('username', $username)->orWhere('name', $username)->orWhere('instagramname', $username)->orWhere('twittername', $username)->orWhere('facebookname', $username)->first();



                for ($i = 1; $i <= ($key); $i++) {

                    if (is_null($find)) {
                        $class = "send_invitation";


                        $append = "<div class='send_invitation_main' data-index=" . $x . "><div class='" . $class . "' style='display:inline;' data-index=" . $x . "><img src='/images/gray.svg' width='17px' /> | " . $value . "</div></div>";
                        \DB::table('tagged_people')->insert(['article_id' => $article->id, 'tagged_name' => $username, 'index' => $x, 'read' => 0]);

                    } else {

                        $class = "add_comment";

                        $append = "<div class='add_comment_main' data-index=" . $x . "><div class='add_comment' style='display:inline;' data-index=" . $x . "><img src='/images/blue.png' width='17px' /> | " . $value . "</div></div>";
                        \DB::table('tagged_people')->insert(['user_id' => $find->id, 'article_id' => $article->id, 'tagged_name' => $username, 'index' => $x, 'read' => 0]);
                        if(!(Notification::where('article_id',$article->id)->where('user_id',$article->user_id)->where('auth_user_id',$find->id)->where('type','mention')->first())){
                            Notification::create(['article_id'=>$article->id,'user_id'=>$article->user_id,'auth_user_id'=>$find->id,'type'=>'mention']);
                        }
                        

                    }

                    $newText =  $append;
                    $text = $this->str_replace_n_new($username, $newText, $text, $i);



                    $x++;
                }

                // echo $text;

            }


            $file =  $article->id . '.html';
            $data = $text;
            file_put_contents($file, $data);
            $content = $file;

            \Storage::disk('public')->put('documents', $content);
            $article->update(['content' => $file]);





            $file =  '/' . $article->id . '.html';
            $data = $text;
            $file_original =  '/original' . $article->id . '.html';
            $data_original = $original_content;

            // dd($data);
            file_put_contents(public_path() . $file, $data);
            file_put_contents(public_path() . $file_original, $data_original);

            $content = $file;
            $content_original = $file;


            \Storage::disk('public')->put('documents', $content);
            \Storage::disk('public')->put('documents', $content_original);

            $article->update(['content' => $file, 'original_content' => $file_original]);
        }



        // $data = ['name' => 'http://api_rwrite.momentum-sol.com/api/article/' . $article->id];

        // Mail::send('emails.email_admin', $data, function ($message) {
        //     $message->to('info@r-write.com')->subject('R-Write: Article Review');
        //     $message->from('info@r-write.com', 'R-Write');
        // });

        return redirect('/article/view/' . $article->id);
    }

    public function article_pay(Request $request)
    {
        $id = $request->article_id;
        $cost = $request->cost;
        $article = Article::Where('id', $id)->first();
        return view('website.pages.article.payment', compact('id', 'cost', 'article'));
    }

    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey('sk_test_51HzOMSBvnNTFpcxYRQkZu2ZEG3XsYybVYxY29AZ9NmnmCAEKJwbUpzb2DtSOSrKa8k8oXGMelf5u0nwlvCbqHyK100AGj97DDm');
        Stripe\Charge::create([
            "amount" => $request->cost * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from rwrite website."
        ]);
        \DB::table('purchased_articles')->insert(
            [
                'cost' => $request->cost,
                'user_id' => \Auth::user()->id,
                'article_id' => $request->article_id
            ]
        );
        $article = Article::where('id', $request->article_id)->first();
        $bayer = Auth::user();
        $seller = User::where('id', $article->user_id)->first();

        event(new NotificationDevice($bayer, "Successful transaction! “Cut the Confetti – Congratulations! Think of it to celebrate your awesomeness!", "Rwrite", "index"));
        event(new NotificationDevice($seller, "Someone bought your article", "Rwrite", "index"));

        $bayer_email = $bayer->email;
        $bayer_data = [
            'name' => $bayer->first_name . " " . $bayer->last_name,
        ];

        Mail::send('emails.message_for_bayer', $bayer_data, function ($message) use ($bayer_email) {
            $message->to($bayer_email)->subject('Successful transaction');
            $message->from('info@rwrite.com', 'Successful transaction');
        });

        $seller_email = $seller->email;
        $seller_data = [
            'name' => $seller->first_name . " " . $seller->last_name,
            'buyer' => $bayer->first_name . " " . $bayer->last_name,
        ];

        Mail::send('emails.message_for_seller', $seller_data, function ($message) use ($seller_email) {
            $message->to($seller_email)->subject('Successful transaction');
            $message->from('info@rwrite.com', 'Successful transaction');
        });

        // Session::flash('success', 'Payment successful!');

        return redirect('/article/view/' . $request->article_id);
    }

    public function send(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'email' => 'required|string|email|max:100',
        ], [
            'phone.required' => 'phone is required',
            'email.required' => 'email is required'
        ]);

        if ($validator->fails()) {
            // return Redirect::back()->withErrors($validator)->withInput();
            return response()->json(['error' => $validator->errors()]);
        }

        // Mail 
        $data = [
            'email' => $request['email'],
            'phone' => $request['phone']
        ];

        $email = Auth::user()->email;
        $email_user = $request->email;
        $user_name = $request->name;
        $article_id = $request->article_id;
        $data = ['article_id' => $article_id];
        //dd($data);
        Mail::send('emails.invitation', $data, function ($message) use ($email_user) {
            $message->to($email_user)->subject('Rwrite Invitation');
            $message->from('info@rwrite.com', 'Rwrite Invitation');
        });
        $url = 'https://newrwrite.msol.dev/article_view/' . $article_id;
        $sms_message = "You have been invited to Rwrite platform. \n" . $url;

        // SMS 
        send_sms($sms_message, $request['phone']);


        // Back to the same page
        // return Redirect::back()->with('success', 'Email & SMS Sent successfully.');

        return response()->json(['success' => 'Email & SMS Sent successfully.']);
    }
}
