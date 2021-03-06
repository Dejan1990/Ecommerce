<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.product.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required|min:3',
            'image' => 'required|mimes:jpeg,png',
            'price' => 'required|numeric',
            'additional_info' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required'
        ]);

        $data = $request->all();
        $data['image'] = $request->file('image')->store('public/product'); 

        Product::create($data);

        notify()->success('Product created successfully!');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.product.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required|min:3',
            'image' => 'mimes:jpeg,png',
            'price' => 'required|numeric',
            'additional_info' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required'
        ]);

        $data = $request->all();
        $image = $product->image;
        if($request->file('image')){
            $image = $request->file('image')->store('public/product');
            Storage::delete($product->image);
        }

        $data['image'] = $image;
        $product->update($data);
        notify()->success('Product updated successfully!');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $filename = $product->image;
        $product->delete();
        Storage::delete($filename);
        notify()->success('Product deleted successfully!');
        return redirect()->route('product.index');
    }

    public function loadSubCategories(Request $request, Category $category)
    {
        $subcategory = Subcategory::where('category_id', $category->id)->pluck('name', 'id');
        return response()->json($subcategory);
    }
}
