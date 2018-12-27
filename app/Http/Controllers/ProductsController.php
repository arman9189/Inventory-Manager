<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\Supplier;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all the products
        $products = Product::all();

        // Return the index view
        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get product categories and suppliers
        $categories = ProductCategory::all();
        $suppliers = Supplier::all();

        // Return the create view
        return view('products.create')->with('categories', $categories)->with('suppliers', $suppliers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate user input
        $this->validate($request, [
          'name' => 'required|min:3|max:150|unique:products',
          'description' => 'required|min:3|max:500',
          'product_category_id' => 'required|numeric',
          'supplier_id' => 'required|numeric',
          'sales_price' => 'required|numeric',
          'buy_price' => 'required|numeric',
          'instock' => 'required|numeric|between:0,1',
          'discontinued' => 'required|numeric|between:0,1'
        ]);

        // Create new instance of the model
        $product = new Product;

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->product_category_id = $request->input('product_category_id');
        $product->supplier_id = $request->input('supplier_id');
        $product->sales_price = $request->input('sales_price');
        $product->buy_price = $request->input('buy_price');
        $product->instock = $request->input('instock');
        $product->discontinued = $request->input('discontinued');

        // Save the new product
        $product->save();

        // Return to index view with success message
        return redirect('/products')->with('success', 'Product has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        // Get the product to edit
        $product = Product::find($product);

        // Get suppliers and categories
        $suppliers = Supplier::all();
        $categories = ProductCategory::all();

        // Return the edit view
        return view('products.edit')->with('product', $product)->with('suppliers', $suppliers)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product)
    {
        // Get the product
        $product = Product::find($product);

        // Validate user input
        $this->validate($request, [
          'name' => 'required|min:3|max:150|unique:products,name,'.$product->id,
          'description' => 'required|min:3|max:500',
          'product_category_id' => 'required|numeric',
          'supplier_id' => 'required|numeric',
          'sales_price' => 'required|numeric',
          'buy_price' => 'required|numeric',
          'instock' => 'required|numeric|between:0,1',
          'discontinued' => 'required|numeric|between:0,1'
        ]);

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->product_category_id = $request->input('product_category_id');
        $product->supplier_id = $request->input('supplier_id');
        $product->sales_price = $request->input('sales_price');
        $product->buy_price = $request->input('buy_price');
        $product->instock = $request->input('instock');
        $product->discontinued = $request->input('discontinued');

        // Save the updated product
        $product->save();

        // Return to index view with success message
        return redirect('/products')->with('success', 'Product has been edited and changes were saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
