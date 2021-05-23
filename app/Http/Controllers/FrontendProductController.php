<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
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
        $productFromSameCategories = Product::inRandomOrder()
            ->where('category_id', $product->category_id)
            ->where('id','!=', $product->id)
            ->limit(3)
            ->get();

        return view('frontend.product.show', [
            'product' => $product,
            'productFromSameCategories' => $productFromSameCategories
        ]);
    }

    public function allProduct(Category $category, Request $request)
    {
        //$category = Category::where('slug', $name)->first();
        $filterSubCategories = []; //140.Frontend rememeber checkbox state->ovo smo dodali da bi varijabla uvek postojala, i kad otvorimo ovu stranu i nismo nijedan Subcategory stiklirali

        if($request->subcategory){
            $products = $this->filterProducts($request);
            $filterSubCategories = $this->getSubcategoriesId($request);
        } else {
            $products = Product::where('category_id', $category->id)->get();
        }

        $subcategories = Subcategory::where('category_id', $category->id)->get();

        return view('frontend.category.index', [
            'category' => $category,
            'products' => $products,
            'subcategories' => $subcategories,
            'filterSubCategories' => $filterSubCategories
        ]);
    }

    public function filterProducts(Request $request)
    {
        $subId = [];
        $subcategory = Subcategory::whereIn('id', $request->subcategory)->get();
        foreach($subcategory as $sub){
            array_push($subId, $sub->id);
        }
        $products = Product::whereIn('subcategory_id', $subId)->get();
        return $products;
    }

    public function getSubcategoriesId(Request $request)
    {
        $subId = [];
        $subcategory = Subcategory::whereIn('id', $request->subcategory)->get();
        foreach($subcategory as $sub){
            array_push($subId, $sub->id);
        }
        return $subId;
    }
}
