<?php

namespace App\Http\Controllers;

use App\Order;
use App\Customer;
use App\Product;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all orders
        $orders = Order::all();

        // return view with orders
        return view('orders.index')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get customers and products
        $customers = Customer::all();
        $products = Product::all();

        $order_statuses = [
          'Quote' => 'Quote',
          'Quote sent' => 'Quote sent',
          'Back order' => 'Back order',
          'Processing' => 'Processing',
          'Awaiting payment' => 'Awaiting payment',
          'Ready to ship' => 'Ready to ship',
          'Shipped' => 'Shipped',
          'Cancelled' => 'Cancelled'
        ];

        // return view
        return view('orders.create')->with('customers', $customers)->with('products', $products)->with('statuses', $order_statuses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $this->validate($request, [
          'customer_id' => 'required|numeric',
          'status' => 'required|max:150',
          'product_id' => 'required|array|min:1',
          'product_id.*' => 'required|numeric',
          'quantity' => 'required|array|min:1',
          'quantity.*' => 'required|numeric',
          'notes' => 'nullable|min:3|max:500'
        ]);

        $products = $request->input('product_id');
        $quantities = $request->input('quantity');

        $order = new Order;

        if(!Input::has('notes')) {
          $order->notes = '<p>No notes.</p>';
        } else {
          $order->notes = $request->input('notes');
        }

        $order->customer_id = $request->input('customer_id');
        $order->status = $request->input('status');

        $order->save();
        $id = $order->id;

        for($i = 0; $i < count($products); $i++) {
          DB::table('order_products')->insert([
            'order_id' => $id,
            'product_id' => $products[$i],
            'quantity' => $quantities[$i]
          ]);
        }

        return redirect('/products')->with('success', 'Order has been created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($order_id)
    {
        // get the order
        $order = Order::find($order_id);

        // get products
        $order_products = DB::table('order_products')
        ->where('order_id', $order_id)
        ->join('products', 'order_products.product_id', '=', 'products.id')
        ->get();

        // return view
        return view('orders.show')->with('order', $order)->with('products', $order_products);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
