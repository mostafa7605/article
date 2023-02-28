<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function manualLogin(){
        if (!request()->isMethod('post')){
            return view('admin.login');
        }
        else{


            if (Auth::attempt(['email' => request('email'),'password' => request('password')])){

                return redirect('admin/welcome');
            }else{
                return back()->withErrors(['msg' => 'There is something wrong']);
            }
        }
    }

    public function manualLogout(){

        // return redirect('/admin/home');
        return redirect('/');
    }
    public function profil_edit(){
        $user=User::where('id',Auth::user()->id)->first();
        return view('admin.edit_profile', compact('user'));
    }
    public function saveinfo(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name'=>'required',
            'username'=>'required',
            'phone'=>'required|numeric|unique:users,phone,'.Auth::user()->id,
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,


        ]);
        if($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $path=User::where('id',Auth::user()->id)->first();
            $path= $path->image;
            if($request->hasFile('image')){


                $image = time().'.'.$request->image->extension();

                $request->image->move(public_path('users/image/'), $image);
                $path=('users/image/').$image;


                }

            User::where('id',Auth::user()->id)->update(['first_name'=>$request->first_name,
        'last_name'=>$request->last_name,
        'phone'=>$request->phone,
        'email'=>$request->email,
        'username'=>$request->username,
        'image'=>$path
    ]);
    return redirect('admin/users')->with('status','Your profile updated successfully');

    }


    public function all_messages(){
        $messages=Message::all();
        return view('admin.all_messages', compact('messages'));
    }
     public function delete_message($id)
    {
        Message::where('id',$id)->delete();
        return redirect('admin/messages')->with('status', 'Message deleted successfully' );
    }
    public function view_one_message($id){
         Message::where('id',$id)->update(['seen'=>1]);
        $message=Message::where('id',$id)->first();

        return view('admin.view_message', compact('message'));
    }
    public function send_message_reply(Request $request){
        $email=$request->email;
        $data=['name'=>$request->name,'email'=>$email,'message1'=>$request->message,'reply'=>$request->reply];

        Mail::send('emails.reply_message', $data, function ($message) use ($email) {
            $message->to($email)->subject('R-Write: Comment Notification');
            $message->from('hadeel.mostafa.cs@gmail.com', 'R-Write');
            });
            return redirect('admin/messages')->with('status', 'Email sent successfully' );

    }


}
