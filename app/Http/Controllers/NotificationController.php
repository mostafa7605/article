<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function view(){
        return view('website.pages.notification.view');
    }
}
