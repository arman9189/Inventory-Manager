<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
		protected $table = 'product_stocks';
		public $timestamps = true;

		public function product()
		{
				return $this->belongsTo('App\Product');
		}
}
