<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProducts extends Migration
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
            $table->string('product_name', 255);
            $table->string('product_description', 255);
            $table->string('product_quantity', 255);
            $table->string('product_price', 255);
            $table->string('product_image_url', 255);
            $table->integer('category_ids')->unsigned();
            $table->foreign('category_ids')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table-> timestamp('created_at')->useCurrent();
            $table-> timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_products');
    }
}
