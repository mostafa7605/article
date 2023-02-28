<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\CategoryProducts;
use App\Models\ImageSlider;

class ImageSliderController extends Controller
{

    public function get(Request $request) 
    {
        $images=ImageSlider::orderBy('order')->get();
        return response()->json([
            'message' => 'Image Sliders returned successfully ',
            'data' => $images,
       
        ], 201);
        
    }
}