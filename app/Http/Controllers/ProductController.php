<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Retrieve all products from the database

        return view('index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('products.show', compact('product'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'starting_price' => 'required|numeric|min:0',
            'auction_end' => 'required|date',
        ]);

        $product = new Product();
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->starting_price = $validatedData['starting_price'];
        $product->current_price = $validatedData['starting_price'];
        $product->auction_end = $validatedData['auction_end'];
        $product->user_id = auth()->id();
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
}
