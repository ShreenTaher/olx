<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Category::whereNotNull('parent_id')
            ->orderBy('created_at', 'DESC')->get();
        if (Route::current()->getPrefix() == 'olx/') {
            return view('olx.subcategories.index',compact('subcategories'));
        }
        return response()->json(['subcategories' => $subcategories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')
            ->orderBy('created_at', 'DESC')->get();
        return view('olx.subcategories.create', compact('categories'));
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
            'parent_id' => 'required',
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
            'parent_id' => $request->parent_id,
            'image' => $imgName,
        ]);
        return redirect('olx/subcategories')->with('success', 'subcategory added successfully');
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
            $categories = Category::whereNull('parent_id')
                ->orderBy('created_at', 'DESC')->get();
            $subcategory=Category::find($id);
            return view('olx.subcategories.create',compact('subcategory', 'categories'));
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
        $subcategory = Category::find($id);
        if ((request('name')) != '') {
            if ((request('name')) != $subcategory->name) {
                // validate request data
                $this->validate($request, [
                    'name' => 'unique:categories'
                ]);
            }
            $subcategory->name = request('name');
        }
        if ((request('parent_id')) != '') {
            $subcategory->parent_id = request('parent_id');
        }
        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'image|mimes:jpeg,png,jpg|max:1024',
            ]);
            $old_file = 'images/categories/' . $subcategory->image;
            if (is_file($old_file)) unlink($old_file);

            $imgName = unique_file($request->file('image')->getClientOriginalName());
            $request->file('image')->move(
                base_path() . '/public/images/categories/', $imgName
            );
            $subcategory->image = $imgName;
        }
        $subcategory->save();
        return redirect('olx/subcategories')->with('success', 'subcategory updated successfully');
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
        Category::destroy($id);
    }
    public function subCategories($id)
    {
        $category = Category::find($id);
        if(! $category)
            return response()->json(['msg' => 'invalid data']);
        $subcategories = Category::where('parent_id', $category->id)->get();
        return response()->json(['subcategories' => $subcategories]);
    }
}
