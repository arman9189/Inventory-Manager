<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->mediumText('description');
            $table->integer('product_category_id')->unsigned();
            $table->integer('supplier_id')->unsigned();
            $table->decimal('sales_price', 8, 2);
            $table->decimal('buy_price', 8, 2);
            $table->boolean('instock');
            $table->boolean('discontinued');

            $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
