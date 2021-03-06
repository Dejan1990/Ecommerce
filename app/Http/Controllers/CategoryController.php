<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$categories = Category::get(); Ako koristimo paginate ne mozemo da koristimo get, all()...
        $categories = Category::latest()->paginate(10);
        return view('admin.category.index', [ 'categories' => $categories ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        return view('admin.category.create', [
            'category' => $category
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
        $this->validate($request, [
            'name' => 'required|unique:categories',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,png'
        ]);

        $image = $request->file('image')->store('public/files');

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'image' => $image
        ]);

        notify()->success('Category created successfully!');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', [ 'category' => $category ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        /* $image = $category->image;
        if($request->hasFile('image')){
            $image = $request->file('image')->store('public/files');
            \Storage::delete($category->image);
        }
        $category->name= $request->name;
        $category->description= $request->description;
        $category->image=$image;
        $category->save();
        notify()->success('Category updated successfully!');
        return redirect()->route('category.index');*/

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpeg,png'
        ]);

        $data = $request->all();
        $image = $category->image;
        if($request->hasFile('image')){
            $image = $request->file('image')->store('public/files');
            Storage::delete($category->image);
        }

        $data['image'] = $image;
        $category->update($data);
        notify()->success('Category updated successfully!');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $filename = $category->image;
        $category->delete();
        Storage::delete($filename);
        notify()->success('Category deleted successfully!');
        return redirect()->route('category.index');
    }
}
