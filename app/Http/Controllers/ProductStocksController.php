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

    public function moveStock(Request $request)
    {
      // validate
      $this->validate($request, [
        'storage_location_id_source' => 'required|numeric',
        'storage_location_id_destination' => 'required|numeric',
        'product_id' => 'required|numeric',
        'quantity' => 'required|numeric|gt:0'
      ]);

      // bind to vars for easier use
      $source_id = $request->input('storage_location_id_source');
      $destination_id = $request->input('storage_location_id_destination');
      $quantity_to_move = $request->input('quantity');
      $product_id = $request->input('product_id');

      // check if source and destination are the same
      if($source_id == $destination_id) {
        return redirect('/stock/move')->with('error', 'Source and destination location can not be the same!')->withInput();
      }

      // get stock record for source
      $source_stock_record = DB::table('product_stocks')->where([
        ['product_id', '=', $product_id],
        ['storage_location_id', '=', $source_id]
      ])->get();

      // check if source location has the product
      if(!$source_stock_record->first()) {
        return redirect('/stock/move')->with('error', 'Stock at the source location is not sufficient to move that amount of products!')->withInput();
      }

      // retrieve source stock record
      $source_stock_record = ProductStock::where([
        ['product_id', '=', $product_id],
        ['storage_location_id', '=', $source_id]
      ])->first();

      // check if quantity is sufficient
      if($source_stock_record->quantity < $quantity_to_move) {
        return redirect('/stock/move')->with('error', 'Stock at the source location is not sufficient to move that amount of products!')->withInput();
      }

      // calculate new stock
      $new_source_quantity = $source_stock_record->quantity - $quantity_to_move;

      // check for destination stock record
      $destination_stock_record = DB::table('product_stocks')->where([
        ['product_id', '=', $product_id],
        ['storage_location_id', '=', $destination_id]
      ])->get();

      // check if it exists
      if(!$destination_stock_record->first()) {
        // doesnt exist, create it
        $destination_stock_record = new ProductStock;

        $destination_stock_record->product_id = $product_id;
        $destination_stock_record->quantity = $quantity_to_move;
        $destination_stock_record->storage_location_id = $destination_id;

        $destination_stock_record->save();

        // update source record
        DB::table('product_stocks')->where([
          ['product_id', '=', $product_id],
          ['storage_location_id', '=', $source_id]
        ])->update(['quantity' => $new_source_quantity]);

        return redirect('/products')->with('succes', 'Stock has been updated successfully!');
      } else {
        // update source record
        DB::table('product_stocks')->where([
          ['product_id', '=', $product_id],
          ['storage_location_id', '=', $source_id]
        ])->update(['quantity' => $new_source_quantity]);

        // get destination record
        $destination_stock_record = DB::table('product_stocks')->where([
          ['product_id', '=', $product_id],
          ['storage_location_id', '=', $destination_id]
        ])->first();

        $new_destination_quantity = $destination_stock_record->quantity + $quantity_to_move;

        DB::table('product_stocks')->where([
          ['product_id', '=', $product_id],
          ['storage_location_id', '=', $destination_id]
        ])->update(['quantity' => $new_destination_quantity]);

        return redirect('/products')->with('success', 'Stock has been updated successfully!');
      }
      return redirect('/products')->with('error', 'An unknown error has occured. Ref: #0012');
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

    public function moveView()
    {
       // get products and locations
       $products = Product::all();
       $locations = StorageLocation::all();

       // return the move stock view
       return view('product-stocks.move-products')->with('products', $products)->with('locations', $locations);
    }
}
