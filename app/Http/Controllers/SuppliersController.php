<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\Product;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all the suppliers
        $suppliers = Supplier::all();

        // Return the index view
        return view('suppliers.index')->with('suppliers', $suppliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the create view
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the user input
        $this->validate($request, [
          'name' => 'required|min:3|max:50|unique:suppliers',
          'website' => 'required|min:3|max:150|starts_with:http,https'
        ]);

        // Create new instance of the model
        $supplier = new Supplier;

        $supplier->name = $request->input('name');
        $supplier->website = $request->input('website');

        // Save the new model
        $supplier->save();

        // Return to index with success message
        return redirect('/suppliers')->with('success', 'Supplier has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($supplier_id)
    {
        // get supplier and products
        $supplier = Supplier::find($supplier_id);
        $products = Product::where([
          ['supplier_id', '=', $supplier_id],
        ])->get();

        // return view
        return view('suppliers.show')->with('supplier', $supplier)->with('products', $products);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($supplier)
    {
        // Get the supplier to edit
        $supplier = Supplier::find($supplier);

        // Return the edit view
        return view('suppliers.edit')->with('supplier', $supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $supplier)
    {
        // Get the supplier
        $supplier = Supplier::find($supplier);

        // Validate the user input
        $this->validate($request, [
          'name' => 'required|min:3|max:50|unique:suppliers,name,'.$supplier->id,
          'website' => 'required|min:3|max:150|starts_with:http,https'
        ]);

        // Edit the supplier
        $supplier->name = $request->input('name');
        $supplier->website = $request->input('website');

        // Save the changes
        $supplier->save();

        // Return to index page with success message
        return redirect('/suppliers')->with('success', 'Supplier has been edited and changes were saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
