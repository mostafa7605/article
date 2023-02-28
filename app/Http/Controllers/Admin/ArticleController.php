<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Admin;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Auth;
use App\Models\Product;
use App\Models\ImageSlider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;

class ArticleController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:article-list|article-create|article-edit|article-delete', ['only' => ['index','store']]);
         $this->middleware('permission:article-create', ['only' => ['create','store']]);
         $this->middleware('permission:article-edit', ['only' => ['edit','update','approved']]);
         $this->middleware('permission:article-delete', ['only' => ['destroy']]);
         $this->middleware('permission:article-hide', ['only' => ['show']]);

    }

    public function index($name)
    {
        if($name=='video_film')
        {
            $type=Category::where('name','Video Film')->first();

        }
        elseif($name=='album_cover')
        {
            $type=Category::where('name','Album Cover')->first();

        }
        else
        {
            $type=Category::where('name',$name)->first();

        }
        if( !is_null($type))
        {
            $articles=Article::where('category_id',$type->id)->get();

        }
        else
        {
            $articles=collect();
        }


    return view('admin.articles.index',compact('articles'));
    }


    public function approved($id,$approved)
    {
        $article=Article::where('id',$id)->first();

        Article::where('id',$id)->update(['approved'=>$approved]);
            if($approved==1)
            {
                dd($article->tagged_people);


            $tagged_people =$article->tagged_people;

            foreach( $tagged_people as $user)
            {
                if($user->id!=$article->user_id)
                {



            $data=['name'=> $user->username,
            'url'=>'http://api_rwrite.momentum-sol.com/api/article/'.$id];
            $email= $user->email;

            foreach(  $user->devices as $device)
            {
            $msg = array(
            "body" => 'R-Write:Someone Tagged You In Article',
            "title" => 'R-Write: Someone Tagged You In Article');
            $data_notifi = array(
            "uid" => $id);

            $fields = array(
            'to' =>$device->device_token,
            'data' => $data_notifi,
            'notification' => $msg,
            'priority' => 'high',
            );
            $headers = array(
            'Authorization: key=' . 'AAAAJIdnnWQ:APA91bEyGHsQg6fcV0s0QWAL6JAXADpiSg85GYDBQh1mLxyNGYmnsU3XrXv6X8BwM1cLkjg5gkqkFbc9pkGlpbPt7Qdi6tm4dWGFKPo-a0X1hE2DTUrhhkTYIwQOvj4US1HIkdfSTo0t',
            'Content-Type: application/json'
            );
            #Send Reponse To FireBase Server
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);


            }

            Mail::send('emails.email_comment', $data, function ($message) use ($email) {
            $message->to($email)->subject('R-Write: Tagged Article');
            $message->from('hadeel.mostafa.cs@gmail.com', 'R-Write');
            });
        }
            }
            }
        return Redirect::back()->with('status', 'Article Updated successfully');


    }


    public function show($id,$show)
    {
        $article=Article::where('id',$id)->first();

        Article::where('id',$id)->update(['show'=>$show]);
        return Redirect::back()->with('status', 'Article Updated successfully' );


    }


    public function delete($id)
    {
        $article=Article::where('id',$id)->delete();


        return Redirect::back()->with('status', 'Article Deleted Successfully' );


    }

}
