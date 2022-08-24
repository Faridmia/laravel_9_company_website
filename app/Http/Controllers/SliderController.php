<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    //

    public function Allslider() {
        $sliders = Slider::latest()->paginate(5);
        return view('admin.slider.index',compact('sliders'));
    }

    public function StoreSlider(Request $request) {
        $validatedData = $request->validate([
            'slider_title' => 'required',
            'slider_desc'  => 'required',
            'slider_image' => 'required|mimes:jpg,jpeg,png',
        ],
        [
            'slider_title.required' => 'Please Input Slider Title',
            'slider_desc.required' => 'Please Input Slider Description',
            'slider_image.min' => 'Slider Longer Then 4 characters',
        ]);

        $slider_image = $request->file('slider_image');

        $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension(); 
        Image::make($slider_image)->resize(300,200)->save('image/slider/'.$name_gen );

        $last_img = 'image/slider/'.$name_gen;

        Slider::insert([
            'title'       => $request->slider_title,
            'description' => $request->slider_desc,
            'image'       =>  $last_img,
            'created_at'  => Carbon::now(),
        ]);

        return redirect('/slider/all')->with('message','Brand Save Successfully..');
    }

    public function SliderEdit( $id ) {
        $sliders = Slider::find($id); // elequoent ORM

        return view('admin.slider.edit',compact('sliders'));
    }

    public function SliderUpdate( Request $request,$id ) {

        $validatedData = $request->validate([
            'slider_title' => 'required',
            'slider_desc' => 'required',
        ],
        [
            'slider_title.required' => 'Please Input slider title',
        ]);

        $old_image = $request->old_image;

        $slider_image = $request->file('brand_image');

        if( $slider_image ) { 

            $name_gen    = hexdec(uniqid());
            $img_ext     = strtolower($slider_image->getClientOriginalExtension()); 
            $img_name    = $name_gen. '.'.$img_ext;
            $up_location = 'image/slider/';
            $last_img    = $up_location.$img_name;
            $slider_image->move($up_location,$img_name);
    
            unlink($old_image);
    
            Slider::find($id)->update([
                'title' => $request->slider_title,
                'description' => $request->slider_desc,
                'image' =>  $last_img,
                'created_at'  => Carbon::now(),
            ]);

            return Redirect()->route('all.slider')->with('success','slider updated');

        } else {
            Slider::find($id)->update([
                'title' => $request->slider_title,
                'description' => $request->slider_desc,
                'created_at'  => Carbon::now(),
            ]);
            return Redirect()->route('all.slider')->with('success','slider updated');

        }

    }

    public function SliderDelete( $id ) {

        $img = Slider::find($id);
        $old_image = $img->image;

        unlink($old_image);

        Slider::find($id)->delete();

        return Redirect()->back()->with('success','Slider Delete Success');
        
    }

    public function Logout() {
        Auth::logout();
        return Redirect()->route('login')->with('success','User Logout');
    }
}
