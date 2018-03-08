<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopFocusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_focus', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('店铺关注关联序号');
            $table->integer('uid', false)->comment('关注者id');
            $table->integer('shop_id', false)->comment('店铺id');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shop_focus');
    }
}
