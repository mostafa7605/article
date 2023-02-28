<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdditionalField;
use App\Models\Article;
use App\Models\DeviceToken;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use Socialite;
use App\Models\Category;
use App\Models\Comment;
use App\Events\NotificationDevice;
use App\Models\Notification;
class CommentController extends Controller
{
    public function save_comment(Request $request)
    {   
        $user_auth=User::find($request->user_token);
        $article=Article::find($request->article_id);
        if($user_auth)
        {
        Comment::create(['user_id'=>$user_auth->id,'article_id'=>$request->article_id,'tagged_name'=>$request->taggedName,'comment'=>$request->comment,'index'=>$request->index]);
        Notification::create(['article_id'=>$request->article_id,'user_id'=>$user_auth->id,'auth_user_id'=>$article->user_id,'type'=>'comment']);

        $id=$request->article_id;
        $tagged_people =$article->tagged_people;

        foreach( $tagged_people as $user)
        {
        if($user_auth->id!=$user->id )
        {



        $data=[  'name'=>$user_auth->first_name." ".$user_auth->last_name,
   
        'article_name'=>$article->title,
        'article_id'=>$article->id,
        'comment'=>$request->comment];
        $email= $user->email;

        foreach(  $user->devices as $device)
        {
        $msg = array(
        "body" => 'R-Write:Someone Commented  In Article',
        "title" => 'R-Write: Someone Commented  In Article');
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

        \Mail::send('emails.email_comment', $data, function ($message) use ($email) {
        $message->to($email)->subject('R-Write: Comment Notification');
        $message->from('info@rwrite.com', 'R-Write');
        });
       }
        }
        $owner=User::where('id',$article->user_id)->first();
        $owner_email=$owner->email;
        $owner_data=[
            'name'=>$user_auth->first_name." ".$user_auth->last_name,
            'owner_name'=>$owner->first_name." ".$owner->last_name,
            'article_name'=>$article->title,
            'article_id'=>$article->id,
            'comment'=>$request->comment
        ];
        Mail::send('emails.owner_email_comment', $owner_data, function ($message) use ($owner_email) {
        $message->to($owner_email)->subject('R-Write: Comment Notification');
        $message->from('info@rwrite.com', 'R-Write');
        });

        event(new NotificationDevice($owner,"someone commented on your article ".$article->title,"Rwrite","index"));

        return response()->json([
        'success' => 'done',

        ], 200);

        }
        else
        {
        return response()->json([
        'error' => true,

        ], 500);
        }

    }

        public function get_comment(Request $request){
            $tagged_name = str_replace("@", "", $request->tagged_name);
            $comments= Comment::where('article_id',$request->article_id)->where('index',$request->index)->where('tagged_name',$tagged_name)->get();
            

            $output='';
            if (count($comments)>0){
                foreach ($comments as $comment){

                    $output.='
                     <div class="border-bottom p-3">
                    <div class="" style="border-color:#1877F2;"><div class="tooltip-content"><div class="tooltip-content-content"><span style="color:#fff">'.strtoupper(substr($comment->user->first_name,0,1)).'</span></div><div class="cox"><h3 class="text_name_red_mention" style="color:#804E08">@'.$comment->user->username.'</h3><span style="color: #AAAAAA;font-size: 10px;margin-left: 9px;">9 : 12 pm</span></div></div></div>
                    <div class="d-flex mt-3 align-items-center">
                        <p style="font-size: 10px;padding: 3px;color: #838383;margin-left: 12px !important;">'.$comment->comment.'</p>
                    </div>
                </div> ';
                 
                }
           
            }
            return $output;

        }
}
