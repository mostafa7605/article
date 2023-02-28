<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Admin;
use Illuminate\Http\Request;
use Auth;
use App\Models\Product;
use App\Models\ImageSlider;

class ImageSliderController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:image-slider-list|image-slider-create|image-slider-edit|image-slider-delete', ['only' => ['index','store']]);
         $this->middleware('permission:image-slider-create', ['only' => ['create','store']]);
         $this->middleware('permission:image-slider-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:image-slider-delete', ['only' => ['destroy']]);
    }

        public function index()
        {
        $imageSliders=ImageSlider::all();

        return view('admin.images_sliders.index',compact('imageSliders'));
        }

        public function add_image_slider()
        {

        return view('admin.images_sliders.create');
        }

        public function store(Request $request)
        {


        if($request->hasFile('image')){


            $image = time().'.'.$request->image->extension();

            $request->image->move(public_path('images/image_sliders/'), $image);
            $path=('images/image_sliders/').$image;


        }
        ImageSlider::create(['image'=>$path,'order'=>$request->order]);
        return redirect('admin/image_sliders');
        }

        public function delete($id)
        {
            ImageSlider::where('id',$id)->delete();
            return redirect('admin/image_sliders')->with('status', 'Image Slider deleted successfully' );
        }


        public function edit($id)
        {
            $image_slider=ImageSlider::where('id',$id)->first();
            return view('images_sliders.edit',compact('image_slider'));
        }

            public function update_image_slider (Request $request ,$id)
            {
            $path= ImageSlider::where('id',$id)->first();
            $path= $path->image;


            if($request->hasFile('image')){


            $image = time().'.'.$request->image->extension();

            $request->image->move(public_path('images/image_sliders/'), $image);
            $path=('images/image_sliders/').$image;


            }
            ImageSlider::where('id',$id)->update(['order'=>$request->order,'image'=> $path]);
            return redirect('admin/image_sliders')->with('status', 'Image Slider updated successfully' );

            }


}
