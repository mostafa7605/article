<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImageSlider;
use App\Models\Article;

class HomeController extends Controller
{

    public function index()
    {
        $images = ImageSlider::orderBy('order')->get();
        $articles = Article::where('approved', 1)->orderBy('created_at', 'desc')->paginate(12);
        return view('website.pages.index', compact('images', 'articles'));
    }
}
