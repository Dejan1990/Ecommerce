<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendProductController extends Controller
{
    public function index()
    {	
        return view('frontend.product.index');
    }
}
