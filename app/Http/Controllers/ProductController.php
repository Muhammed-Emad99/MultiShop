<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    function create()
    {
        $categories = Category::all();
        return view('products.create', ['categories' => $categories]);
    }

    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'digits_between:2,10'],
            'quantity' => ['required', 'numeric', 'digits_between:2,10'],
            'featured' => ['required', 'boolean'],
            'recent' => ['required', 'boolean'],
            'category_id' => ['required'],
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png,bmp,gif,svg'],
        ]);

        if ($validator->fails()) {
            return redirect('products/create')->withInput()->withErrors($validator);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destination = public_path('/uploads/products');
            $file_name = $request->name . "-" . \Str::random(5) . "." . $image->getClientOriginalExtension();
            $image->move($destination, $file_name);
        }
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'featured' => $request->featured,
            'recent' => $request->recent,
            'category_id' => $request->category_id,
            'image' => $file_name,
        ]);
        $product->save();
        return redirect()->route('products.index');
    }

}
