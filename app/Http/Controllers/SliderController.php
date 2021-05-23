<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
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
        return back();
    }
}
