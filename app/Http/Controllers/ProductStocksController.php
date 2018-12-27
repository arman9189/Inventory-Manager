<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductStock;
use App\Product;
use App\StorageLocation;
use DB;

class ProductStocksController extends Controller
{
    public function addStock(Request $request)
		{
			// validate user input
			$this->validate($request, [
				'storage_location_id' => 'required|numeric',
				'product_id' => 'required|numeric',
				'quantity' => 'required|numeric'
			]);

			$location = $request->input('storage_location_id');
			$product = $request->input('product_id');
			$quantity = $request->input('quantity');

			// check for existing record
			$stockrecord = DB::table('product_stocks')->where([
				['product_id', '=', $product],
				['storage_location_id', '=', $location],
			])->get();

			if(!$stockrecord->first()) {
				// stockrecord doesn't exit, create one

				// create new instance of the model
				$productstock = new ProductStock;

				$productstock->storage_location_id = $location;
				$productstock->product_id = $product;
				$productstock->quantity = $quantity;

				// save the new stock record
				$productstock->save();

				// redirect to index
				return redirect('/products')->with('success', 'Stock has been updated successfully!');
			} else {
				// record exists, retrieve it
				$productstock = ProductStock::where([
					['product_id', '=', $product],
					['storage_location_id', '=', $location]
				])->first();

				$newquantity = $productstock->quantity + $quantity;

				// update the stock
				DB::table('product_stocks')->where([
					['product_id', '=', $product],
					['storage_location_id', '=', $location],
				])->update(['quantity' => $newquantity]);

				// return to index
				return redirect('/products')->with('success', 'Stock has been updated successfully!');
			}
		}

		// TODO: check if stock is there, make this func
		public function removeStock(Request $request)
		{
			// validate user input
			$this->validate($request, [
				'storage_location_id' => 'required|numeric',
				'product_id' => 'required|numeric',
				'quantity' => 'required|numeric'
			]);

			$location = $request->input('storage_location_id');
			$product = $request->input('product_id');
			$quantity = $request->input('quantity');

			// check for existing record
			$stockrecord = DB::table('product_stocks')->where([
				['product_id', '=', $product],
				['storage_location_id', '=', $location],
			])->get();

			if(!$stockrecord->first()) {
				// stockrecord doesn't exit, throw error
        return redirect('/stock/remove')->with('error', 'This product is not in stock and can not be checked out!');
			}

      // record exists, retrieve it
      $productstock = ProductStock::where([
        ['product_id', '=', $product],
        ['storage_location_id', '=', $location]
      ])->first();

      // check if stock is sufficient
      if($productstock->quantity < $quantity) {
        // quantity not sufficient, throw error
        return redirect('/stock/remove')->with('error', 'Product stock is not sufficient to check out that amount of products! (Tried to check out ' . $quantity . ', only ' . $productstock->quantity . ' available)');
      }

      $newquantity = $productstock->quantity - $quantity;

      // update the stock
      DB::table('product_stocks')->where([
        ['product_id', '=', $product],
        ['storage_location_id', '=', $location],
      ])->update(['quantity' => $newquantity]);

      // return to index
      return redirect('/products')->with('success', 'Stock has been updated successfully!');
		}

		public function addView()
		{
			 // get products and storage locations
			 $products = Product::all();
			 $locations = StorageLocation::all();

			 // return add stock view
			 return view('product-stocks.add-products')->with('products', $products)->with('locations', $locations);
		}

		public function removeView()
		{
			 // get products and storage locations
			 $products = Product::all();
			 $locations = StorageLocation::all();

			 // return add stock view
			 return view('product-stocks.remove-products')->with('products', $products)->with('locations', $locations);
		}
}
