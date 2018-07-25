<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::whereNull('parent_id')
            ->get();
        if (Route::current()->getPrefix() == 'olx/') {
            return view('olx.categories.index',compact('categories'));
        }
        foreach ($categories as $category) {
            $child = Category::where('parent_id', $category->id)->first();
            if($child)
                $category['child'] = true;
            else
                $category['child'] = false;
        }
        return response()->json(['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('olx.categories.create');
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
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024'
        ]);
        if ($request->hasFile('image')) {
            $imgName = unique_file($request->file('image')->getClientOriginalName());
            $request->file('image')->move(
                base_path() . '/public/images/categories/', $imgName
            );
        }
        Category::create([
            'name' => $request->name,
            'image' => $imgName,
        ]);
        return redirect('olx/categories')->with('success', 'category added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Route::current()->getPrefix() == 'olx/') {
            $category=Category::find($id);
            return view('olx.categories.create',compact('category'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if ((request('name')) != '') {
            if ((request('name')) != $category->name) {
                // validate request data
                $this->validate($request, [
                    'name' => 'unique:categories'
                ]);
            }
            $category->name = request('name');
        }
        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'image|mimes:jpeg,png,jpg|max:1024',
            ]);
            $old_file = 'images/categories/' . $category->image;
            if (is_file($old_file)) unlink($old_file);

            $imgName = unique_file($request->file('image')->getClientOriginalName());
            $request->file('image')->move(
                base_path() . '/public/images/categories/', $imgName
            );
            $category->image = $imgName;
        }
        $category->save();
        return redirect('olx/categories')->with('success', 'category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('cat_id', $id)->delete();
        Category::where('parent_id', $id)->delete();
        Category::destroy($id);
    }
}
