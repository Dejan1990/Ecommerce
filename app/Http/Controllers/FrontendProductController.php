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
        } elseif ($request->min || $request->max){
            $products = $this->filterByPrice($request);
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

    private function filterByPrice(Request $request)
    {
        //$categoryId = $request->categoryId; //$categoryId se podudara sa $categoryId u allProduct($name, Request $request)
        $product = Product::whereBetween('price', [$request->min, $request->max ])->where('category_id', $request->categoryId)->get();
        return $product;
    }

    private function filterProducts(Request $request)
    {
        $products = Product::whereIn('subcategory_id', $this->checkboxRequest($request))->get();
        return $products;
    }

    private function getSubcategoriesId(Request $request)
    {
        return $this->checkboxRequest($request);
    }

    private function checkboxRequest(Request $request)
    {
        $subId = [];
        $subcategory = Subcategory::whereIn('id', $request->subcategory)->get();
        foreach($subcategory as $sub){
            array_push($subId, $sub->id);
        }
        return $subId;
    }
}
