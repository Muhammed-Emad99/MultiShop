<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    function home()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('userView.home.home', ['categories' => $categories, 'products' => $products]);
    }

    function index()
    {
        $categories = Category::all();
        return view('categories.index', ['categories' => $categories]);
    }

    function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'image' => 'required|image|mimes:jpeg,jpg,png,bmp,gif,svg',
        ]);

        if ($validator->fails()) {
            return redirect('categories/create')->withInput()->withErrors($validator);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destination = public_path('/uploads/categories');
            $file_name = $request->name . "-" . \Str::random(5) . "." . $image->getClientOriginalExtension();
            $image->move($destination, $file_name);
        }
        $category = Category::create([
            'name' => $request->name,
            'image' => $file_name,
            'parent_id' => $request->parent_id
        ]);
        $category->save();
        return redirect()->route('categories.index');
    }

    function create()
    {
        $categories = Category::all();
        return view('categories.create', ['categories' => $categories]);
    }


}
