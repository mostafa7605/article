<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin;
use Illuminate\Http\Request;
use Auth;
use App\Models\Product;
use App\Models\ImageSlider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class NewImageSliderController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:image-slider-list|image-slider-create|image-slider-edit|image-slider-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:image-slider-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:image-slider-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:image-slider-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $imageSliders = ImageSlider::paginate(5);

        return view('admin.images_slider_new.index', compact('imageSliders'));
    }
    public function destroy($id)
    {
        ImageSlider::where('id', $id)->delete();
        return redirect('admin/image_sliders')->with('status', 'Image Slider deleted successfully');
    }
    public function create()
    {
        return view('admin.images_slider_new.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order' => 'required|unique:images_sliders,order',
            'image' => 'required',
            'title' => 'required',

        ]);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }


        if ($request->hasFile('image')) {


            $image = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images/image_sliders/'), $image);
            $path = ('images/image_sliders/') . $image;
        }
        ImageSlider::create(['title' => $request->title, 'description' => $request->description, 'image' => $path, 'order' => $request->order, 'deeb_link' => $request->deeb_link]);
        return redirect('admin/image_sliders')->with('status', 'Image Slider Created successfully');
    }

    public function edit($id)
    {
        $image_slider = ImageSlider::where('id', $id)->first();
        return view('admin.images_slider_new.edit', compact('image_slider'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'order' => 'required|unique:images_sliders,order,' . $id,
            'description' => 'required',
            'title' => 'required',


        ]);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $path = ImageSlider::where('id', $id)->first();
        $path = $path->image;


        if ($request->hasFile('image')) {


            $image = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images/image_sliders/'), $image);
            $path = ('images/image_sliders/') . $image;
        }
        ImageSlider::where('id', $id)->update(['title' => $request->title, 'description' => $request->description, 'order' => $request->order, 'image' => $path, 'deeb_link' => $request->deeb_link]);
        return redirect('admin/image_sliders')->with('status', 'Image Slider updated successfully');
    }
}
