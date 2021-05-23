<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
		$sliders = Slider::get();
		return view('admin.slider.index', [ 'sliders' => $sliders ]);
	}

    public function create()
    {
    	return view('admin.slider.create');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'image' => 'required|mimes:jpeg,png'
    	]);

    	$image = $request->file('image')->store('public/slider');
    	Slider::create([
    		'image' => $image
    	]);
    	notify()->success('Image uploaded successfully!');
        return redirect()->route('slider.index');
    }

    public function destroy(Slider $slider)
    {
    	$slider->delete();
    	notify()->success('Image deleted successfully!');
        return back();
    }
}
