<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
		protected $table = 'product_categories';
		public $timestamps = true;

		public function products()
		{
			return $this->hasMany('App\Product');
		}
}
