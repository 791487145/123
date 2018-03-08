<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopSubOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_sub_order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('note')->nullable();
            $table->integer('uid', false)->nullable();
            $table->integer('order_id', false)->nullable();
            $table->string('order_code')->nullable();
            $table->integer('object_id', false)->nullable();
            $table->tinyInteger('object_type', false)->nullable();
            $table->tinyInteger('status', false)->nullable();
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
        Schema::drop('shop_sub_order');
    }
}
