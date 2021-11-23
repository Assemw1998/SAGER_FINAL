<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_email', 255)->unique();
            $table->string('user_first_name', 255);
            $table->string('user_last_name', 255);
            $table->string('user_password', 255);
            $table->integer('product_ids')->unsigned();
            $table->foreign('product_ids')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_users');
    }
}
