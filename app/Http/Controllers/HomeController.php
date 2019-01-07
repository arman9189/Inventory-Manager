<?php

namespace App\Http\Controllers;
use App\Order;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // get recent orders
        $orders = Order::orderBy('id', 'DESC')->take(10)->get();

        return view('home')->with('orders', $orders);
    }
}
