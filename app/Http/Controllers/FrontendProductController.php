<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendProductController extends Controller
{
    public function index()
    {	
        $products = Product::latest()->limit(9)->get();
    	$randomActiveProducts = Product::inRandomOrder()->limit(3)->get();
    	$randomActiveProductIds = [];
    	foreach($randomActiveProducts as $product){
    		array_push($randomActiveProductIds, $product->id);
    	}
    	$randomItemProducts = Product::whereNotIn('id', $randomActiveProductIds)->limit(3)->get();
        $categories = Category::all();
        return view('frontend.product.index', [
            'products' => $products,
            'randomActiveProducts' => $randomActiveProducts,
            'randomItemProducts' => $randomItemProducts,
            'categories' => $categories
        ]);
    }

    public function show(Product $product)
    {
        return view('frontend.product.show', [ 'product' => $product ]);
    }
}
