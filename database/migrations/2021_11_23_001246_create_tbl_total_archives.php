<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTotalArchives extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('total_archives', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('total_products');
            $table->integer('total_categories');
            $table->integer('total_users');
            $table->string('created_day',255);
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
        Schema::dropIfExists('tbl_total_archives');
    }
}
