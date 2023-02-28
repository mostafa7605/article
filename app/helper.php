<?php

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

// ============================================ SEND SMS =====================================
    function send_sms($message,$receiverNumber) {
       /* $receiverNumber = '+201126007605';
        $message = 'hello from R-Write';*/
        // dd( $request->all());
        $account_sid = "AC1b3f2c1f71b3eff9d02faaf0cf402294";
        $auth_token = "97e00a55faf0c458d00eca6d4797260e";
        $twilio_number = "+19294163464";

        $client = new Client($account_sid, $auth_token);
        $client->messages->create($receiverNumber, [
            'from' => $twilio_number, 
            'body' => $message
        ]);        
    }

// ============================================ SEND MAIL =====================================
    function send_mail($email,$email_user,$user_name,$data){

        Mail::send('emails.message', $data, function ($message) use ($email , $email_user ,$user_name) {
            $message->to($email_user)->subject('R-Write');
            $message->from($email, $user_name);
        });
    }
?>