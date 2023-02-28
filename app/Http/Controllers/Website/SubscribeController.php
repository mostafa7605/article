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
use App\Models\Subscribe;
use Stripe\Subscription;

class SubscribeController extends Controller
{
    public function subscribe(Request $request)
    {
        $found = Subscribe::where('email', $request->email)->first();
       
        if (is_null($found)) {
            Subscribe::create(['email' => $request->email]);
        }
        return view('website.pages.mail.stay');
    }
}
